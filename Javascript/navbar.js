/*
// navbar.js
function generateNavbar() {
  var navbar = document.getElementById('navbar');
  
  // Create the toggle button for small screens
  var toggleButton = document.createElement('button');
  toggleButton.classList.add('nav-toggle');
  toggleButton.textContent = '☰'; // Using ☰ as a simple menu icon
  navbar.appendChild(toggleButton);

  // Create the navigation list
  var navList = document.createElement('ul');
  navList.classList.add('nav-list');
  // Define your page links and titles
  var links = [
    { href: '../HTML/index.html', text: 'Home' },
    { href: '../HTML/exhibitions.html', text: 'Exhibitions' },
    { href: '../HTML/artists.html', text: 'Artists' },
    { href: '../HTML/events.html', text: 'Events' },
    { href: '../HTML/visitor-info.html', text: 'Visitor Info' },
    { href: '../HTML/membership-form.html', text: 'Membership' },
    { href: '../HTML/ticket-booking.html', text: 'Tickets' },
    { href: '../HTML/art-submission.html', text: 'Art Submission' },
    { href: '../HTML/about-us.html', text: 'About Us' },
    { href: '../HTML/contact.html', text: 'Contact' }
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

  // Add the list to the navbar
  navbar.appendChild(navList);

  // Event listener for the toggle button
  toggleButton.addEventListener('click', function() {
      navList.classList.toggle('active');
  });
}

// Call the generateNavbar function when the DOM is fully loaded
if (document.readyState !== 'loading') {
  generateNavbar();
} else {
  document.addEventListener('DOMContentLoaded', generateNavbar);
}
*/

// navbar.js
function generateNavbar() {
  var navbar = document.getElementById('navbar');
  
  // Create the navigation list
  var navList = document.createElement('ul');
  navList.classList.add('nav-list');

  // Define your page links and titles
  var links = [
    { href: '../HTML/index.html', text: 'Home' },
    { href: '../HTML/exhibitions.html', text: 'Exhibitions' },
    { href: '../HTML/artists.html', text: 'Artists' },
    { href: '../HTML/events.html', text: 'Events' },
    { href: '../HTML/visitor-info.html', text: 'Visitor Info' },
    { href: '../HTML/membership-form.html', text: 'Membership' },
    { href: '../HTML/ticket-booking.html', text: 'Tickets' },
    { href: '../HTML/art-submission.html', text: 'Art Submission' },
    { href: '../HTML/about-us.html', text: 'About Us' },
    { href: '../HTML/contact.html', text: 'Contact' }
  ];
      // ... add the rest of your menu items here

  // Generate the list items and links
  links.forEach(function(link) {
      var li = document.createElement('li');
      var a = document.createElement('a');
      a.href = link.href;
      a.textContent = link.text;
      li.appendChild(a);
      navList.appendChild(li);
  });

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