const textToCopy = document.getElementById("account-number").textContent;

const accountnum = document.createElement('input');
accountnum.value = textToCopy;

document.getElementById("copy-account-num").addEventListener('click', () => {
    const copiedText = accountnum.value;
  
    navigator.clipboard.writeText(copiedText)
      .then(() => {

      })
      .catch((error) => {
        console.error('Failed to copy text: ', error);
      });
  });
