const sign_in_btn=document.querySelector("#sign-in-btn");
const sign_up_btn=document.querySelector("#sign-up-btn");
const container=document.querySelector(".container");
var captcha=document.getElementById("captcha");

sign_up_btn.addEventListener('click',()=>{
    container.classList.add("sign-up-mode");
});

sign_in_btn.addEventListener('click',()=>{
    container.classList.remove("sign-up-mode");
});

var signupButton=document.getElementById("form-sign-up-button");
var up_name=document.getElementById("name");
var email=document.getElementById("email");
var phn=document.getElementById("phn");
var add=document.getElementById("add");
var pass=document.getElementById("pass");
var re_pass=document.getElementById("re_pass");

signupButton.addEventListener('click',()=>{
  if(!up_name.value.length==0 && !email.value.length==0 && !add.value.length==0 && !phn.value.length==0 && !pass.value.length==0 && !re_pass.value.length==0 && !captcha.value.length==0){
    if(pass.value===re_pass.value){
      if( captcha.value===code.textContent){
        document.getElementById("submit").click();
      }
      else{
         swal({
         title: 'Captcha Does Not Match.',
         text: '',
         icon: 'error',
         });
      }
    }
    else{
     swal({
       title: 'Password Does Not Match With Re Password',
       text: '',
       icon: 'error',
       });
    }
    }
    else{
     swal({
       title: 'No Field Can be Empty',
       text: '',
       icon: 'error',
       });
    }
});

const wrapper = document.querySelector(".wrapper");
const fileName = document.querySelector(".file-name");
const cancelBtn = document.querySelector("#cancel-btn i");
const selectBtn = document.querySelector(".select");
const showBtn= document.querySelector(".botton-img");
const img = document.querySelector(".preview-img");
var popup= document.querySelector('.popup');
let regExp = /[0-9a-zA-Z\^\&\'\@\{\}\[\]\,\$\=\!\-\#\(\)\.\%\+\~\_ ]+$/;

var validImageTypes = ["image/gif", "image/jpeg", "image/png"];

function createCaptcha()  {
  let letters = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z',
  'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z', '0','1','2','3','4','5','6','7','8','9'];
  let a = letters[Math.floor(Math.random() * letters.length)] ;
  let b = letters[Math.floor(Math.random() * letters.length)] ;
  let c = letters[Math.floor(Math.random() * letters.length)] ;
  let d = letters[Math.floor(Math.random() * letters.length)] ;
  let e = letters[Math.floor(Math.random() * letters.length)] ;
  let f = letters[Math.floor(Math.random() * letters.length)] ;
  let g = letters[Math.floor(Math.random() * letters.length)] ;
  let code = a + b + c + d + e + f + g ;
  return code ;
};
const changeTextBtn = document.querySelector('.changeText') ;
window.addEventListener('load' , () => {
    code.textContent = createCaptcha() ;
}) ;

changeTextBtn.addEventListener('click' , () => {
  code.textContent = createCaptcha() ;
}) ;

$('input[type="file"]').on("change",function(){
   var label = $("label[for='" + $(this).attr('id') + "']");
   
   const file = this.files[0];
   var fileType = file['type'];
   if(file && validImageTypes.includes(fileType)){
       popup.classList.add("show");
       const reader = new FileReader();
       reader.onload = function(){
       const result = reader.result;
       img.src = result;
       wrapper.classList.add("active");
     }
     cancelBtn.addEventListener("click", function(){
       img.src = "";
       popup.classList.remove("show");
       wrapper.classList.remove("active");
     })
 
     selectBtn.addEventListener("click",function(){
       popup.classList.remove("show");
       label.text(file.name);
       img.src="";
       wrapper.classList.remove("active");
     })
      reader.readAsDataURL(file);
   }
   else{
      alert("Wrong Image Format");
   }
   if(this.value){
     let valueStore = this.value.match(regExp);
     fileName.textContent = valueStore;
   }
  });


$(".menu-toggle-btn").click(function(){
  $(".navigation_bar_class").toggleClass("active");
});
