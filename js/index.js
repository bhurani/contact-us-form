'use strict';

const form = document.forms[0],
      statusTxt = form.querySelector('span');

form.onsubmit = e =>{
  e.preventDefault();

  form.classList.add('disable');
  statusTxt.innerText = 'Sending your message...';
  statusTxt.style.color = 'var(--blue)';
  statusTxt.style.display = 'block';

  const name = form.name.value,
        email = form.email.value,
        phone = form.phone.value,
        website = form.website.value,
        message = form.message.value;

  fetch('./php/index.php', {
    method: 'POST',
    body: JSON.stringify({name, email, phone, website, message}),
    headers : {'Content-Type':'application/json; charset=UTF-8'}
  })
  .then(response => response.text())
  .then(txt =>{
    if(txt.indexOf('sent') !== -1){
      form.reset();
      setTimeout(() => statusTxt.style.display = 'none', 3000);
    }else{
      statusTxt.style.color = 'red';
    }

    statusTxt.innerText = txt;
    form.classList.remove('disable');
  })
  .catch(err => console.log(err));
};