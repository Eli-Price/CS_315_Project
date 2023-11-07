// navbar.js
function generateNavbar() {
  // Create the navbar element
  var nav = document.createElement('nav');
  var ul = document.createElement('ul');
  
  // List of pages and their titles
  var pages = [
      { href: '../HTML/index.html', title: 'Home' },
      { href: '../HTML/exhibitions.html', title: 'Exhibitions' },
      { href: '../HTML/artists.html', title: 'Artists' },
      { href: '../HTML/events.html', title: 'Events' },
      { href: '../HTML/visitor-info.html', title: 'Visitor Info' },
      { href: '../HTML/membership-form.html', title: 'Membership' },
      { href: '../HTML/ticket-booking.html', title: 'Tickets' },
      { href: '../HTML/art-submission.html', title: 'Art Submission' },
      { href: '../HTML/about-us.html', title: 'About Us' },
      { href: '../HTML/contact.html', title: 'Contact' }
  ];

  // Create a list item for each page
  pages.forEach(function(page) {
      var li = document.createElement('li');
      var a = document.createElement('a');
      a.href = page.href;
      a.textContent = page.title;
      li.appendChild(a);
      ul.appendChild(li);
  });

  // Append the list to the nav element
  nav.appendChild(ul);

  // Append the nav to the div with id 'navbar'
  document.getElementById('navbar').appendChild(nav);
}

// Call the function to generate the navbar when the window loads.
window.onload = generateNavbar;