
window.onload = function(){

  window.title = document.getElementsByClassName('title')

  main(title);

};



function main(title){

  for(x= 0; x< title.length; x++){
  title[x].onclick = function(){
    //title[x].getAttribute('id');
    loadtitle();
  };
}

  function loadtitle(){
    let httpRequest = new XMLHttpRequest();
    let url = "description.php";
    httpRequest.onreadystatechange = function(){
      if (httpRequest.readyState === XMLHttpRequest.DONE){
        if(httpRequest.status === 200){
          response = httpRequest.responseText.replace('<!DOCTYPE html><html><head><title>New User Page</title><link rel="stylesheet" type="text/css" href="main.css"><link rel="stylesheet" type="text/css" href="newUserScreen.css"><script type = "text/javascript" src = "scripts/loadpages.js"></script></head><body></body></html><link rel="stylesheet" type="text/css" href="issue.css"><link rel="stylesheet" type="text/css" href="issue.css"><link rel="stylesheet" type="text/css" href="issue.css">','');
          document.body.innerHTML = response;

        }
        else{
          alert("there was a problem with this request");
        }
      }
    }
    httpRequest.open('GET',url);
    httpRequest.send();
  }

}
