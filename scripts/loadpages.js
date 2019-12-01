
window.onload = function(){

  window.home = document.getElementById('homelink');
  window.issue = document.getElementById('issuelink');
  window.user = document.getElementById('userlink');

  main(home,issue,user);

};



function main(home,issue,user){


  home.onclick = function(){
    loadhome();
  };

  issue.onclick = function(){
    loadNewIssue();
  };

  user.onclick = function(){
    loadAddUser();
  };

  function loadhome(){
    let httpRequest = new XMLHttpRequest();
    let url = "home.php";
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



  function loadNewIssue(){
    let httpRequest = new XMLHttpRequest();
    let url = "issue.php";
    httpRequest.onreadystatechange = function(){
      if (httpRequest.readyState === XMLHttpRequest.DONE){
        if(httpRequest.status === 200){
          response = httpRequest.responseText;
          document.documentElement.innerHTML = response.replace('<!DOCTYPE html>','');

        }
        else{
          alert("there was a problem with this request");
        }
      }
    }
    httpRequest.open('GET',url);
    httpRequest.send();
  }



  function loadAddUser(){
    let httpRequest = new XMLHttpRequest();
    let url = "newUserScreen.html";
    httpRequest.onreadystatechange = function(){
      if (httpRequest.readyState === XMLHttpRequest.DONE){
        if(httpRequest.status === 200){
          response = httpRequest.responseText;
          document.documentElement.innerHTML = response.replace('<!DOCTYPE html>','');

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

main(home,issue,user);
