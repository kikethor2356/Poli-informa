document.addEventListener("DOMContentLoaded", function() {
    var submenuItems = document.querySelectorAll('.submenu');

    submenuItems.forEach(function(item) {
      item.addEventListener('click', function() {
        item.classList.toggle('active');
      });
    });

    var subcontentLinks = document.querySelectorAll('.submenu a');

    subcontentLinks.forEach(function(link) {
      link.addEventListener('click', function(event) {
        event.preventDefault();
        var targetId = link.getAttribute('href').substring(1);
        var targetContent = document.getElementById(targetId);
        var allContent = document.querySelectorAll('.subcontent');

        allContent.forEach(function(content) {
          content.classList.remove('active');
        });

        targetContent.classList.add('active');
      });
    });
  });