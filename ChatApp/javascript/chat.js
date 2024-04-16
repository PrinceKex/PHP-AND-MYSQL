const form = document.querySelector('.typing-area')
inputField = document.querySelector('.input-field')
sendBtn = document.querySelector('button')
chatBox = document.querySelector('.chat-box')

form.onsubmit = (e) => {
  e.preventDefault() // preventing form submission
}

sendBtn.onclick = () => {
  // start Ajax
  let xhr = new XMLHttpRequest() //create XML Object
  xhr.open('POST', 'php/insert-chat.php', true)
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        inputField.value = '' //leave blank after inserting msg into DB
      }
    }
  }
  // send the form data through ajax to php
  let formData = new FormData(form) //create a new formData object
  xhr.send(formData) //send form data to php
}

setInterval(() => {
  // start Ajax
  let xhr = new XMLHttpRequest() //create XML Object
  xhr.open('POST', 'php/get-chat.php', true)
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response
        chatBox.innerHTML = data
      }
    }
  }
  // send the form data through ajax to php
  let formData = new FormData(form) //create a new formData object
  xhr.send(formData) //send form data to php
}, 500) //runs every  500ms
