const signUpButton = document.getElementById('signUpButton');
const signInButton = document.getElementById('signInButton');
const signInForm = document.getElementById('signIn');
const signUpForm = document.getElementById('signup');

signUpButton.addEventListener('click', function(){
   signInForm.style.display = "none";
   signUpForm.style.display = "block";
});
signInButton.addEventListener('click', function(){
    signInForm.style.display = "block";
    signUpForm.style.display = "none";
 });


 function showProduct(str) {
   if (str == "") {
     document.getElementById("txtHint").innerHTML = "";
     return;
   } else {
     var xmlhttp = new XMLHttpRequest();
     xmlhttp.onreadystatechange = function() {
       if (this.readyState == 4 && this.status == 200) {
         document.getElementById("txtHint").innerHTML = this.responseText;
       }
     };
     xmlhttp.open("GET","display.php?q="+str,true);
     xmlhttp.send();
   }
 }