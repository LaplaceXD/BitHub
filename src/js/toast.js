document.addEventListener("DOMContentLoaded", () => {
  const msg = document.querySelector(".msg");
  if(msg) {
    const [type, content] = msg.textContent.split(":");
    let style;

    switch(type) {
      case "success":
        style = "linear-gradient(to right, #588061, #869f77)";
        break;
      case "error":
        style = "linear-gradient(to right, #de5b6d, #e9765b)";
        break;
    }

    Toastify({
      text: content,
      duration: 3000,
      style: {
        background: style,
      }
    }).showToast();
  }
});