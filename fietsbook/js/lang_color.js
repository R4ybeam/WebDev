let lastScrollTop = 0;

        window.addEventListener("scroll", function () {
            let scrollTop = window.scrollY || document.documentElement.scrollTop;
            let header = document.querySelector('header');

            if (document.getElementById('menu-toggle').checked) {
               document.getElementById('menu-toggle').checked = false;
            }
    
            let headerOpacity = Math.min(1, 1 - scrollTop / 200);
            header.style.backgroundColor = `rgba(228, 77, 38, ${headerOpacity})`;

            let buttons = document.querySelectorAll('.dropbtn');
            buttons.forEach(button => {
                let buttonOpacity = Math.min(1, 1 - scrollTop / 200);
                button.style.backgroundColor = `rgba(111, 34, 50, ${buttonOpacity})`;
            });

            lastScrollTop = scrollTop;
        });

        function setLanguage(lang) {
            console.log("Language switched to: " + lang);
        }

        function setColorScheme(scheme) {
            console.log("Color scheme switched to: " + scheme);
        }

        const checkbox = document.getElementById('menu-toggle');
        const YChangeMain = document.getElementById('MAIN');
        
    
        checkbox.addEventListener('change', function() {
          if (checkbox.checked) {
            // Checkbox is checked, override the margin
            YChangeMain.style.margin = '12rem 1rem 1rem 1rem';
            
            
          } else {
            // Checkbox is unchecked, revert to the original margin
            YChangeMain.style.margin = '';
            
          }
        });