
const scriptURL = 'https://script.google.com/macros/s/AKfycbws5Z-6YYSN4auMhZBlL_svjDref0R0YIr_6wMBess1-eWkKbs/exec'
const form = document.forms['submit-to-google-sheet']

form.addEventListener('submit', e => {
  e.preventDefault()
  fetch(scriptURL, { method: 'POST', body: new FormData(form)})
    .then(response => console.log('Success!', response))
    .catch(error => console.error('Error!', error.message))
})
window.open("register.html","_top");

/*https://script.google.com/macros/s/AKfycbwdSj-xDHbvNQVPngRXEvtz8rE245pdYj5boj1stVNhadvWuWpI/exec*/
