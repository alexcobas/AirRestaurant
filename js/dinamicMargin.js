function ajustarMargen() {
    const menu = document.getElementsByClassName('fixed-top')[0];
    const menuHeight = menu.offsetHeight;
    document.body.style.paddingTop = menuHeight + 'px';
  }
  window.onload = ajustarMargen;
  window.onresize = ajustarMargen;