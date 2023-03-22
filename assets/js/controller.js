$(document).ready(function() {
  $('input[type="submit"]').click(function(event) {
    event.preventDefault();
    document.querySelector('#screen-layer').style.display = 'block';
    $('#screen-layer img').velocity({ scaleX: [4,4], scaleY: [4,4], rotateZ: [360,0] }, { duration: 2000, easing: 'linear', loop: true });
    var action = this.value;
    document.querySelector('#action').value = action;
    
    setTimeout(function() {
      document.forms[0].submit();
    }, 1000);
  });

  function getChoices() {
    var choices = [];
    
    if(formResp.search('adventure') != -1) {
      choices.push("live life as an adventure");
    }
  
    if(formResp.search('help others') != -1) {
      choices.push("help others, more than yourself");
    }
  
    if(formResp.search('not sure') != -1) {
      choices.push("figure things out");
    }
  
    if(formResp.search('fight for social change') != -1) {
      choices.push("fight for social change");
    }
  
    var str = '<center>';
  
    for(var i = 0; i < choices.length; i++) {
      str += '<q>' + choices[i] + '</q><br>'; 
    }
  
    document.querySelector('#selection').innerHTML = str + '</center>';
  }

  try {
    getChoices();
  } catch(e) {
    console.log(e);
  }
});