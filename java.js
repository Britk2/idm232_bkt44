const fill = document.getElementById('fill'); // filter mode
const filter_button = document.querySelectorAll('.filter_b') //filter button
const filter_b = document.getElementById('filter_b');
const search_b = document.getElementById('search_b'); //search button
const search_field = document.getElementById('search_bar') // search field
const info = document.getElementById('info'); // help mode
const help_button = document.querySelectorAll('.quest'); // help button
const help_b = document.getElementById('quest');

console.log(fill);



search_b.addEventListener('click', () => {
    search_field.hidden = !search_field.hidden;
    
    if (help_b.hidden) {
        filter_b.hidden = !filter_b.hidden;
        help_b.hidden = !help_b.hidden;
        if (!info.hidden) {
            info.hidden = !info.hidden;
        }
        if (!fill.hidden) {
            fill.hidden = !fill.hidden;
        }
    }
    console.log("toggle search");
})

filter_buttton.forEach(button => {
    button.addEventListener('click', () => {
        fill.hidden = !fill.hidden;
        filter_b.hidden = !filter_b.hidden;
        help_b.hidden = !help_b.hidden;
        console.log("toggle filter");
    })
})

help_button.forEach(button => {
    button.addEventListener('click', () => {
        info.hidden = !info.hidden;
        filter_b.hidden = !filter_b.hidden;
        help_b.hidden = !help_b.hidden;
        console.log("toggle help");
    })
})