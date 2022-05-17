class Toggle {
  constructor(toggleSelector, targetSelector, ...classList) {
    this.toggler = document.querySelector(toggleSelector);
    this.target = document.querySelector(targetSelector);
    this.classList = classList;
    console.log("Yep!");
    this.toggle = this.toggle.bind(this);
  }

  get isActive() {
    let isActive = false;    
    for(const css of this.classList) {
      if(this.target.classList.contains(css)) {
        isActive = true;
      }
    }

    return isActive;
  }

  toggle() {
    if(!this.isActive) {
      this.target.classList.add(...this.classList);
    } else {
      this.target.classList.remove(...this.classList);
    }
  }
}