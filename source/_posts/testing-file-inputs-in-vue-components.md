---
extends: _layouts.post
title: Testing file inputs in vue components
description: An approach to testing file inputs that is both simple and effective
nutshell: Don't bother trying to mock or stub the files property of the file input. Rather add a method that can be both stubbed and tested, and allows you to test with your own file objects.
post_date: 19 August 2018
section: post_content
published: true
---

<h3 class="font-sans text-sm">The setup</h3>

Let's say we are making an AvatarUpload component. The component includes a file input, which allows the user to select an image to use as their avatar. Once they have selected an image, the component would validate the selected file, then upload it and notify the user of the result. A preview of the image will also be shown while it is uploaded.

So our Vue component may look something like this:

```html
<template>
    <!-- some other template stuff  -->
    <input type="file" id="unique-id" @change="handleImageSelected" />
    <!-- more template stuff  -->
</template>

<script>
import uploadImage from "./uploadImage";

export default {
    // some stuff

    methods: {
        handleImageSelected(ev) {
            const file = ev.target.files[0];

            if(isValidImage(file)) {
                return this.processImage(image);
            }

            this.$emit("invalid-file");
        },

        isValidImage(file) {
            //checks if file is image and under a certain size
        },

        processImage(image_file) {
            this.showPreview(image_file);
            uploadImage(image_file)
                .then(() => this.$emit("avatar-updated"))
                .catch(() => this.$emit("upload-failed"));
        }
    }
}
</script>
```

<h3 class="font-sans text-sm">The Tests</h3>

From looking at the above, these are some of the tests I would like to have:

- an invalid-file event is emitted if a non-image file is selected
- an invalid-file event is emitted if an file exceeding a certain filesize is selected
- an avatar-updated event is emitted if a valid file is selected (the network request is stubbed)
- an upload-failed event is emitted when the network fails

If you have a look through those tests, it is clear that the first three need you to provide a file with specific criterea. From the vue-test-utils docs, we know we can't change the target of a triggered event, so to test a specific value, we need to do set the input's value ourselves before triggering the event. So we would try something like this:

```js
test("it handles a file input change", () => {
  let wrapper = mount(AvatarUpload);

  let file_input = wrapper.find("file[type=input]");
  //try stub a file with an invalid image type
  file_input.element.files[0] = { type: "text/html" };
  file_input.trigger("change");

  expect(wrapper.emitted()["invalid-file"]).toBeDefined();
});
```

<h3 class="font-sans text-sm">The Problem and a solution</h3>

As nice and readable as this test is, it will not run. The problem is that the files property of a file input must be an object of the FileList type. An it is not easy or reasonably possible to create your own FileList. Now it seems impossible to stub out files for testing. Luckily, there is still an easy way to do it. In our event handler, instead of reading the files from the event itself, we can create a new method whose sole job is to get the file. So now the relevant part of our component will look something like this:

```js
import uploadImage from "./uploadImage";

export default {
  // some stuff

  methods: {
    handleImageSelected(ev) {
      const file = this.takeFile(ev);

      if (isValidImage(file)) {
        return this.processImage(image);
      }

      this.$emit("invalid-file");
    },

    takeFile(ev) {
      return ev.target.files[0];
    }

    // same as before
  }
};
```

As you can see, we are simply passing the event to the takeFile method, and it is responsible for getting the file. Alternatively, we could also discard the event and just get the file from the input using Vue refs, it really doesn't matter. The import thing is that we can easily test both ways.

Now our strategy for our test will be to stub the takeFile method, and have it return a file of our choosing.

```js
test("it emits an invalid-image event if an invalid file is selected", () => {
  let wrapper = mount(AvatarUpload);

  // create mock image, will fail validation due to non image type
  const invalid_image_file = {
    type: "text/html",
    size: 1000
  };

  // stub the takeFile method and set onto wrapper
  let takeFile = sinon.fake().returns(invalid_image_file);
  wrapper.setMethods({ takeFile: takeFile });

  let file_input = wrapper.find("file[type=input]");
  file_input.trigger("change");

  expect(wrapper.emitted()["invalid-image"]).toBeDefined();
});
```

Unless I have made a silly error, this test should now pass. It relies on the change event being emitted, and checks that the validation happened, which is what we want. However, there is a small issue. We have no guarentee that our takeFile method actually works, and even just a small typo there could cripple the whole component. So we need to add one extra test to our suit to cover this. It is a very easy test to write, because the method only depends on what is passed in to it. Something like the following would do:

```js
test("it takes the file from the event", () => {
  let wrapper = mount(AvatarUpload);

  //we can stub out the entire event and file
  const file = { size: 1000, type: "image/png", name: "avatar.png" };
  const event = {
    target: {
      files: [file]
    }
  };

  expect(wrapper.vm.takeFile(event)).toEqual(file);
});
```

Hopefully this has shown an easy way to test file inputs where you need some control over the files in your tests, and saves you some of the time I wasted trying to figure this out.
