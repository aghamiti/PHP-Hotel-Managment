// -------------------------- Validimi i formes per kontakt --------------------------

document.getElementById("censorForm").addEventListener("submit", function(e) {
  e.preventDefault();

  try {
    validateForm();
    console.log("Form submission successful!");
  } catch (error) {
    console.error(error); // Log errorin ne konzole
    alert(error.message); // Shfaq mesazhin e errorit ne alert
  }
});

function validateForm() {
  var name = document.getElementById("name").value.trim();
  var phone = document.getElementById("phone").value.trim();
  var comment = document.getElementById("textarea").value.trim();
  var email = document.getElementById("email").value.trim();

  // Testimi i emrit per te pare se a eshte i thate
  if (name === "") {
    throw new Error("Name cannot be empty");
  }

  // Testimi i emrit per te pare se a ka numra ne te dhe nese ka, te gjuaj error
  if (/\d/.test(name)) {
    throw new Error("Name cannot contain numbers");
  }

  // Validimi per numer te telefonit qe te mos jete i zbrazet si dhe te mos jete numer negativ dhe te mund 
  // te permbaje numra si dhe karakteret +, -, (). 
  if (phone !== "" && (!/^[+\d() -]+$/.test(phone) || parseInt(phone) < 0)) {
    throw new Error("Invalid phone number");
  }

  // Validimi per komentin qe te mos jete i thate
  if (comment === "") {
    throw new Error("Comment cannot be empty");
  }

  // Validimi per email qe te kete nje format valid te email-it
  if (email !== "" && !/^\S+@\S+\.\S+$/.test(email)) {
    throw new Error("Invalid email address");
  }
}