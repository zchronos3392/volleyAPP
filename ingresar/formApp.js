console.log('hola');
document.querySelector('tbody').addEventListener('click', e => {
  if (!e.target.matches('#delete')) return;
  console.log('bonjour');
});
