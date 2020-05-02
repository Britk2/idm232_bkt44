const fill = document.getElementById('fill'); // filter mode
const filter_b = document.getElementById('filter_b') //filter button
const search_b = document.getElementById('search_b'); //search button
const search_field = document.getElementById('search_bar') // search field
const info = document.getElementById('info'); // help mode
const help = document.getElementById('quest') // help button

console.log(fill);



search_b.addEventListener('click', () => {
    search_field.hidden = !search_field.hidden;
    console.log("toggle search");
})

filter_b.addEventListener('click', () => {
    fill.hidden = !fill.hidden;
    console.log("toggle filter");
})

help.addEventListener('click', () => {
    info.hidden = !info.hidden;
    console.log("toggle help");
})