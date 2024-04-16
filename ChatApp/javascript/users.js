const searchBar = document.querySelector('.users .search input')
const searchBtn = document.querySelector('.users .search button')
const usersList = document.querySelector('.users .users-list')

searchBtn.onclick = () => {
  searchBar.classList.toggle('active')
  searchBar.focus()
  searchBtn.classList.toggle('active')
  searchBar.value = ''
}

searchBar.onkeyup = () => {
  let searchTerm = searchBar.value
  if (searchTerm != '') {
    searchBar.classList.add('active')
  } else {
    searchBar.classList.remove('active')
  }
  // start Ajax
  let xhr = new XMLHttpRequest() //create XML Object
  xhr.open('POST', 'php/search.php', true)
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response
        usersList.innerHTML = data
      }
    }
  }
  xhr.setRequestHeader('content-type', 'application/x-www-form-urlencoded')
  xhr.send('searchTerm=' + searchTerm)
}

//update usersList.
setInterval(() => {
  // start Ajax
  let xhr = new XMLHttpRequest() //create XML Object
  xhr.open('GET', 'php/users.php', true)
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response
        if (!searchBar.classList.contains('active')) {
          // if searchBar doesnt contain class active
          usersList.innerHTML = data
        }
      }
    }
  }
  xhr.send()
}, 500) //runs every  500ms
