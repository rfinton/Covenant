window.onload = function() {
  document.querySelector('.image-header').style.height = innerHeight * 0.35 + 'px';

  try {
    if(purl) {
      setCK(purl, 'urpurpose.covenant.edu/');
    }
  } catch(e) {
    console.log(e);
  }

  $('.image-header, .main-text').velocity('fadeIn', 2000);

  if(innerWidth <= 1024) {
    $('.image-header img')
    .velocity(
      { translateY: ['60%','50%'] },
      { delay: 1000, duration: 2000, easing: 'ease-out', queue: false })
    .velocity(
      { opacity: [1,0] },
      { delay: 1000, duration: 2000, easing: 'ease-out', queue: false });
  } else {
    $('.image-header img')
    .velocity(
      { translateX: ['30%','30%'], translateY: ['50%','40%'] },
      { delay: 1000, duration: 2000, easing: 'ease-out', queue: false })
    .velocity(
      { opacity: [1,0] },
      { delay: 1000, duration: 2000, easing: 'ease-out', queue: false });
  }
};

window.onresize = function() {
  document.querySelector('.image-header').style.height = innerHeight * 0.35 + 'px';
};