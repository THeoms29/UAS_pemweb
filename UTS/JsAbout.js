 document.getElementById('about-link').addEventListener('click', function(e) {
    e.preventDefault();
    document.getElementById('about').scrollIntoView({
      behavior: 'smooth',
      block: 'start'
    });
  });
