document.addEventListener("DOMContentLoaded", () => {
  const themeToggle = new Toggle(".theme", "body", "light");
  themeToggle.toggler.addEventListener("click", themeToggle.toggle);
  
  const fields = document.querySelectorAll(".form__input");
  if(fields) {
    for(const field of fields) {
      console.log(field);
      if(field.value) {
        field.classList.add("filled");
      }
  
      field.addEventListener("blur", () => {
        if(field.value) {
          field.classList.add("filled");
        } else {
          field.classList.remove("filled");
        } 
      });
    }
  }
});