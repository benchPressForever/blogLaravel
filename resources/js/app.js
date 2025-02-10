import './bootstrap';

let buttonLike = document.querySelectorAll('.likeButton');
buttonLike.forEach((elem) => {
    elem.addEventListener('click', () => {
        let id = elem.getAttribute('data-id');

        axios.post(`/posts/${id}/add/like`)
            .then(response => {
                document.getElementById('likeCount').textContent = response.data.likes
            })
            .catch(error => {
                console.log('Error:')
            });


    })
});

let buttonAdmin = document.querySelector('.AdminButton');
buttonAdmin.addEventListener('click',() => {
    axios.post('/login',{'email':'admin@admin.ru','password':'12345678'})
        .then(response => {
            window.location.replace("http://127.0.0.1:8000/admin");
        })
        .catch(error => {
            console.log('Error:')
        });
});




