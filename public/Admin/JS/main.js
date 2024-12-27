// SIDEBAR DROPDOWN 
const AllDropdown = document.querySelectorAll('#sidebar .side-dropdown');
const sidebar = document.getElementById('sidebar');

AllDropdown.forEach(item => {
    const a = item.parentElement.querySelector('a:first-child');
    a.addEventListener('click', function (e) {
        e.preventDefault();
        if(!this.classList.contains('active')) {
            AllDropdown.forEach(i => {
                const aLink = i.parentElement.querySelector('a:first-child');
                aLink.classList.remove('active');
                i.classList.remove('show');
            })
        }
        this.classList.toggle('active');
        item.classList.toggle('show');
    });    
    
});

//SIDEBAR COLLAPSE (FAIRE APPARAITRE ET DISPARAITRE LE SIDEBAR)
const toggleSidebar = document.querySelector('nav .toogle-sidebar');

const allSideDivider = document.querySelectorAll('#sidebar .divider');

if(sidebar.classList.contains('hide')){
    allSideDivider.forEach(item => {
        item.textContent = '-'
    })
    allDropdown.forEach(item => {
        const a = item.parentElement.querySelector('a:first-child');
        a.classList.remove('active');
        item.classList.remove('show');
    })
}else {
    allSideDivider.forEach(item => {
        item.textContent = item.dataset.text;
    })
}

toggleSidebar.addEventListener('click', function() {
    sidebar.classList.toggle('hide');

    if(sidebar.classList.contains('hide')){
        allSideDivider.forEach(item => {
            item.textContent = '-'
        })
        allDropdown.forEach(item => {
            const a = item.parentElement.querySelector('a:first-child');
            a.classList.remove('active');
            item.classList.remove('show');
        })
    }else {
        allSideDivider.forEach(item => {
            item.textContent = item.dataset.text;
        })
    }
});


sidebar.addEventListener('mouseleave', function () {
    if(this.classList.contains('hide')) {
        allDropdown.forEach(item => {
            const a = item.parentElement.querySelector('a:last-child');
            a.classList.remove('active');
            item.classList.remove('show');
        });
        allSideDivider.forEach(item => {
            item.textContent = '-'
        })
    }
})



sidebar.addEventListener('mouseenter', function () {
    if(this.classList.contains('hide')) {
        allDropdown.forEach(item => {
            const a = item.parentElement.querySelector('a:last-child');
            a.classList.remove('active');
            item.classList.remove('show');
        });
        
        allSideDivider.forEach(item => {
            item.textContent = item.dataset.text;
        })
    }
})


// PROFIL DROPDOWN
const profil = document.querySelector('nav .profile');
const imgProfil = profil.querySelector('img');
const dropdownProfil = profil.querySelector('.profile-link');
//Faire apparaitre le menu 
imgProfil.addEventListener('click', function(e) {
    dropdownProfil.classList.toggle('show');
});
// Faire disparaitre le menu 
window.addEventListener('click', function(e) {
    if(e.target !== imgProfil){
        if(e.target !== dropdownProfil){
            if(dropdownProfil.classList.contains('show')){
                dropdownProfil.classList.remove('show');
            }
        }
    }
    allMenu.forEach(item => {
        const icon = item.querySelector('.icon');
        const menuLink = item.querySelector('.menu-link');
        if (e.target !== icon){
            if (e.target !== menuLink){
                if(menuLink.classList.contains('show')){
                    menuLink.classList.remove('show');
                }
            }
        }
    });
    
});

//MENU 
const allMenu = document.querySelectorAll('main .content-data .head .menu');

allMenu.forEach(item => {
    const icon = item.querySelector('.icon');
    const menuLink = item.querySelector('.menu-link');
    icon.addEventListener('click', function() {
        menuLink.classList.toggle('show');
    })
});

//Faire apparaitre la messagerie 
messagebtn = document.getElementById('messagebtn');
messagerie = document.querySelector('nav .nav-link .messageriemin');
messagebtn.addEventListener('click', function() {
    messagerie.classList.toggle('show');    
});


//Faire apparaitre la notification 
notifbtn = document.getElementById('notifbtn');
notification = document.querySelector('nav .nav-link .notif');
notifbtn.addEventListener('click', function() {
    notification.classList.toggle('show');    
});

