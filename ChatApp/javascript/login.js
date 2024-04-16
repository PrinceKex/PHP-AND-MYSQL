const form = document.querySelector('.login form')

const continueBtn = form.querySelector('.button input')

const errorTxt = form.querySelector('.error-txt')

form.onsubmit = (e) => {
  e.preventDefault() // preventing form submission
}

continueBtn.onclick = () => {
  // start Ajax
  let xhr = new XMLHttpRequest() //create XML Object
  xhr.open('POST', 'php/login.php', true)
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response
        if (data == 'success') {
          location.href = 'users.php'
        } else {
          errorTxt.textContent = data
          errorTxt.style.display = 'block'
        }
      }
    }
  }
  // send the form data through ajax to php
  let formData = new FormData(form) //create a new formData object
  xhr.send(formData) //send form data to php
}
