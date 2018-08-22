window.addEventListener("load", () => {
  var codes = [].slice.call(document.querySelectorAll("pre code"));

  codes.forEach(code => {
    code.classList.add("hljs");
    var worker = new Worker("/highlighter.js");
    worker.onmessage = function(event) {
      code.innerHTML = event.data;
    };
    worker.postMessage(code.textContent);
  });
});
