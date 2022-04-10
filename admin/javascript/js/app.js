const input = document.getElementById('linkInput');
const button = document.getElementById('submit');

const parser = new DOMParser();

button.addEventListener('click', () => {
  getUrlData(input.value);
  input.value = '';
});

// getting jsonld data and saving them in database mysql
const getUrlData = (url) => {
  try {
    fetch(url)
      .then((response) => response.text())
      .then((data) => {
        const domParse = parser.parseFromString(data, 'text/html'); //string to DOM Document
        const allScriptTags = domParse.querySelectorAll('script'); // catch all the scripts in DOM [nodelists]
        const scriptTagsArrs = Array.from(allScriptTags); // convert nodelist to arrays to use loop
        const targetScript = scriptTagsArrs.filter(
          (script) => script.type === 'application/ld+json'
        );
        if (targetScript) {
          const resData = targetScript[0].innerText;
          // console.log(resData);
          const bodyData = JSON.stringify({ resData, inputUrl: url });
          fetch('http://localhost:7000/recipes/store', {
            method: 'POST',
            body: bodyData,
            headers: { 'Content-Type': 'application/json' },
          })
            .then((response) => {
              console.log(response);
            })
            .catch((error) => {
              console.log(error);
            });
        } else {
          console.log('no such thing');
          return;
        }
      });
  } catch (error) {
    alert('error occured: ', error.message());
  }
};
