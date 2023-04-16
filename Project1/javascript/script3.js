const sign_in_btn = document.querySelector("#sign-in-btn");
const sign_up_btn = document.querySelector("#sign-up-btn");
const container = document.querySelector(".container");
const district = document.querySelector(".district")
const userType = document.querySelector(".userType")

sign_up_btn.addEventListener("click", () => {
  container.classList.add("sign-up-mode");
});

sign_in_btn.addEventListener("click", () => {
  container.classList.remove("sign-up-mode");
});

district.onchange = function()
{	
  console.log(district.value);
  if (district.value=='placeholder') 
  {	
    district.style.color="#aaa"
  }
  else{
    district.style.color="black"
  }
}
userType.onchange = function()
{	
  console.log(userType.value);
  if (userType.value=='placeholder') 
  {	
    userType.style.color="#aaa"
  }
  else{
    userType.style.color="black"
  }
}
