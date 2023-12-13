// navbar.js
function generateNavbar() {
  var navbar = document.getElementById('navbar');
  var userLoggedIn = document.getElementById('userLoggedIn');
  
  // Create the navigation list
  var navList = document.createElement('ul');
  navList.classList.add('nav-list');

  // Define page links and titles
  var links = [
    { href: '../Pages/index.php', text: 'Home' },
    { href: '../Pages/exhibitions.php', text: 'Exhibitions' },
    { href: '../Pages/artists.php', text: 'Artists' },
    { href: '../Pages/events.php', text: 'Events' },
    { href: '../Pages/visitor-info.php', text: 'Visitor Info' },
    { href: '../Pages/community-art.php', text: 'Community' },
    { href: '../Pages/art-submission.php', text: 'Art Submission' },
    { href: '../Pages/about-us.php', text: 'About Us' },
  ];

  // Generate the list items and links
  links.forEach(function(link) {
      var li = document.createElement('li');
      var a = document.createElement('a');
      a.href = link.href;
      a.textContent = link.text;
      li.appendChild(a);
      navList.appendChild(li);
  });

  // Chek if the user is logged in
  if (userLoggedIn) {
    //User is logged in, add the logout and Shopping Cart links
    var cartItem = document.createElement('li');
    var cartLink = document.createElement('a');
    cartLink.href = '../Pages/shopping-cart.php';
    cartLink.textContent = 'Cart';
    cartItem.appendChild(cartLink);
    navList.appendChild(cartItem);

    var logoutItem = document.createElement('li');
    var logoutLink = document.createElement('a');
    logoutLink.href = '../Pages/login.php';
    logoutLink.textContent = 'Logout';
    logoutItem.appendChild(logoutLink);
    navList.appendChild(logoutItem);

  } else {
    // User is not logged in, add the login link
    var loginItem = document.createElement('li');
    var loginLink = document.createElement('a');
    loginLink.href = '../Pages/login.php';
    loginLink.textContent = 'Login';
    loginItem.appendChild(loginLink);
    navList.appendChild(loginItem);
  }

  // Add the list to the navbar
  navbar.appendChild(navList);

  // Create the toggle button for small screens and append to navbar
  var toggleButton = document.createElement('button');
  toggleButton.classList.add('nav-toggle', 'hidden'); // Add 'hidden' class by default
  toggleButton.textContent = '☰'; // Using ☰ as a simple menu icon
  toggleButton.addEventListener('click', function() {
      navList.classList.toggle('active');
  });

  navbar.insertBefore(toggleButton, navbar.firstChild); // Insert the button before the nav list
}

// Call the generateNavbar function when the DOM is fully loaded
if (document.readyState !== 'loading') {
  generateNavbar();
} else {
  document.addEventListener('DOMContentLoaded', generateNavbar);
}