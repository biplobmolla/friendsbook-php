<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;500;600;700;800&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Lato:wght@400;700;900&display=swap');

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Raleway', sans-serif;
}

body {
    background-color: #CCC;
    position: relative;
}

.max__width {
    max-width: 85%;
    margin: auto;
}

a {
    text-decoration: none;
}

ul {
    list-style: none;
}

nav {
    background-color: white;
    padding: 20px 0;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.4);
}

nav .max__width {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

nav ul {
    display: flex;
}

nav ul li {
    margin: 0 20px;
}

nav ul li a,
.logout__btn {
    font-size: large;
    padding: 10px 18px;
    color: black;
    font-weight: 600;
    border: 0;
    border-radius: 6px;
    transition: 0.5s;
    position: relative;
}

nav ul li a span {
    position: absolute;
    top: -8px;
    right: -8px;
    padding: 5px 10px;
    border: 0;
    border-radius: 50%;
    background: crimson;
    color: #fff;
    display: flex;
    justify-items: center;
    align-items: center;
    font-size: 14px;
    transition: 0.4s;
}

nav ul li a:hover span {
    background: #111;
}

.logout__btn {
    background-color: crimson;
    color: #fff;
}

.logout__btn:hover {
    background-color: rgb(129, 17, 39);
}

nav ul li a.active,
nav ul li a:hover {
    background-color: crimson;
    color: #fff;
}

.count {
    font-size: 22px;
    font-weight: 700;
}

.profile__fullname {
    display: inline-block;
    font-size: 20px;
    font-weight: 600;
    color: black;
    padding: 6px 20px;
    border: 2px solid rgba(0, 0, 0, 0.3);
    border-radius: 50px;
    transition: 0.4s;
}

.profile__fullname:hover {
    background-color: rgba(0, 0, 0, 0.2);
    color: #fff;
}

#cancelRequest {
    background-color: green;
}

.friend {
    background-color: black !important;
}

/* Add Post Segment Start */

.add__post__form {
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.add__post {
    width: 40%;
    margin: auto;
    margin-top: 60px;
    padding: 20px;
    background-color: white;
    border: 0;
    border-radius: 6px;
}

.upload__image__label {
    border: 2px dashed rgb(94, 88, 88);
    display: inline-block;
    width: 50%;
    height: 100px;
    position: relative;
    cursor: pointer;
    opacity: 0.6;
}

.upload__image__label i {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-size: 40px;
}

.add__post__input__field {
    width: 100%;
    margin-top: 20px;
    display: flex;
    align-items: center;
}

.add__post__input {
    width: 100%;
    font-size: 18px;
    font-weight: 600;
    padding: 6px 0 6px 15px;
    border: 2px solid grey;
    border-radius: 6px;
    resize: vertical;
}

.add__post__input__field button {
    height: 100%;
    font-size: 16px;
    font-weight: 700;
    padding: 10px 15px;
    margin-left: 10px;
    border: 0;
    border-radius: 6px;
    background-color: blue;
    color: #fff;
    cursor: pointer;
    transition: 0.5s;
}

.add__post__input__field button:hover {
    background-color: rgb(2, 2, 153);
}

/* Add Post Segment End */

/* Post Segment Start */

.posts {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.post {
    width: 40%;
    background-color: white;
    margin: 15px 0;
    border: 0;
    border-radius: 10px;
}

.no__posts {
    text-align: center;
    font-size: 40px;
    margin-top: 50px;
    opacity: 0.3;
}

.post__header {
    display: flex;
    padding: 10px;
    padding-bottom: 0;
}

.post__header__text {
    margin-left: 8px;
}

.post__header img {
    width: 40px;
    height: 40px;
    border: 2px solid blue;
    border-radius: 50%;
}

.post__creator {
    display: block;
    font-size: 15px;
    font-weight: 700;
    color: black;
}

.post__time {
    color: grey;
    font-weight: 600;
    margin-left: 4px;
    font-family: 'Lato', sans-serif;
}

.post__desc {
    font-size: 14px;
    line-height: 18px;
    padding: 14px;
    padding-left: 15px;
    font-weight: 600;
}

.post__img {
    width: 100%;
}

/* Post Segment End */

/* Profile Segment Start */

.profile__body {
    display: flex;
}

aside {
    width: 30%;
    margin: 30px 0 0 30px;
}

.profile__posts {
    width: 100%;
}

.profile__post {
    width: 50%;
    margin: 40px 100px 0 0;
}

.about__top {
    background-color: rgb(243, 240, 240);
    border: 0;
    border-radius: 6px;
    text-align: center;
    padding: 15px;
}

.profile__img {
    width: 160px;
    height: 160px;
    border: 4px solid gray;
    border-radius: 50%;
}

.profile__name {
    margin-top: 10px;
}

.about__info {
    background-color: #fff;
    margin-top: 10px;
    padding: 20px;
    border: 0;
    border-radius: 6px;
}

.about__info__title {
    text-align: center;
    padding: 20px 0 30px 0;
    position: relative;
}

.about__info__title::after {
    content: '';
    position: absolute;
    width: 85%;
    height: 2px;
    background-color: gray;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    margin-bottom: 10px;
}

.history {
    display: flex;
    margin: 10px 0;
}

.history__desc {
    font-size: 15px;
    font-weight: 600;
    margin-left: 10px;
    color: gray;
}

.buttons {
    margin-top: 10px;
}

.about__top__btn {
    font-size: 14px;
    font-weight: 600;
    padding: 8px 14px;
    border: 0;
    border-radius: 8px;
    background-color: blue;
    color: #fff;
    cursor: pointer;
    transition: 0.5s;
    margin: 5px;
}

.about__top__btn i {
    margin-right: 5px;
}

.about__top__btn:hover {
    background-color: rgb(6, 6, 126);
}

.about__top__btn:last-child {
    background-color: rgba(158, 144, 146, 0.6);
    color: black;
}

.about__top__btn:last-child:hover {
    background-color: rgba(158, 144, 146, 1);
}

.fa-comment {
    color: #fff;
}

/* Profile Segment End */

/* Notification Segment Start */

.notifications h1 {
    text-align: center;
    padding: 40px 0;
    opacity: 0.4;
}

.notifications {
    width: 70%;
    background-color: #fff;
    margin: 40px auto 0 auto;
    border: 0;
    border-radius: 14px;
    overflow: hidden;
}

.notification__top__title {
    font-size: 24px;
    padding: 20px 0 20px 20px;
    position: relative;
}

.notification__top__title::after {
    content: '';
    position: absolute;
    width: 100%;
    height: 1px;
    background-color: grey;
    left: 0;
    bottom: 0;
}

.notification {
    display: inline-block;
    position: relative;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 15px;
    border-bottom: 2px solid rgba(189, 183, 183, 0.4);
    color: black;
    transition: 0.4s;
}

.notification:hover {
    background: rgba(189, 183, 183, 0.4);
}

.notification__info {
    display: flex;
    align-items: center;
}

.notification__text {
    margin-left: 15px;
}

.notification img {
    width: 80px;
    height: 80px;
    border: 0;
    border-radius: 50%;
}

.fa-bell {
    position: absolute;
    font-size: 26px;
    top: 13px;
    left: 13px;
}

.fa-ellipsis-vertical {
    font-size: 24px;
    cursor: pointer;
    padding: 20px 30px;
    border: 0;
    border-radius: 50%;
    transition: 0.5s;
}

.notification .fa-comment {
    font-size: 26px;
    color: black;
    cursor: pointer;
    transition: 0.5s;
}

.fa-ellipsis-vertical:hover,
.fa-comment:hover {
    background: rgba(189, 183, 183, 0.4);
}

.notification__desc {
    font-size: 14px;
    color: grey;
    margin-left: 5px;
    font-weight: 600;
}

/* Notification Segment End */

/* Friend Request Segment Start */

.friend__request__btn {
    padding: 6px 12px;
    cursor: pointer;
    background-color: green;
    color: #fff;
    border: 0;
    border-radius: 4px;
    transition: 0.5s;
}

.friend__request__btn:hover {
    background-color: rgb(3, 53, 3);
}

.friend__request__btn:last-child {
    background-color: red;
}

.friend__request__btn:last-child:hover {
    background-color: rgb(139, 4, 4);
}

.friend__request__btn i {
    margin-right: 5px;
}

/* Friend Request Segment End */

/* Registration and Login Form Segment Start */

.register__body {
    height: 100vh;
}

.register__form {
    background-color: #fff;
    width: 40%;
    margin: 50px auto 0 auto;
    border: 0;
    border-radius: 10px;
    overflow: hidden;
    padding: 20px;
}

.register__input__field {
    width: 100%;
    position: relative;
    margin: 15px 0;
}

/* .register__label {
    position: absolute;
    top: 50%;
    left: 10px;
    font-size: 16px;
    font-weight: 500;
    padding: 0 3px;
    background-color: #fff;
    color: gray;
    transform: translateY(-50%);
    transition: 0.5s;
} */

.register__input {
    width: 100%;
    padding: 6px 0 6px 14px;
    border: 0;
    outline: 0;
    border-bottom: 1px solid gray;
    font-size: 16px;
    font-weight: 600;
}

.register__input:focus {
    border-bottom: 2px solid black;
}

.register__input::placeholder {
    font-size: 16px;
    font-weight: 600;
    color: rgb(189, 189, 189);
}

.register__form .notification__top__title {
    border-bottom: 1.2px solid rgba(0, 0, 0, 1);
}

.login__btn {
    text-align: right;
}

.regi_link {
    margin-left: 35%;
    font-size: 20px;
    padding: 6px 15px;
    border: 0;
    border-radius: 6px;
    background: #ccc;
    color: #111;
    font-weight: 700;
    transition: 0.4s;
}

.regi_link:hover {
    background: #999;
}

.submit__btn {
    font-size: 16px;
    font-weight: 700;
    padding: 6px 20px;
    border: 0;
    border-radius: 5px;
    background-color: blue;
    color: #fff;
    cursor: pointer;
    transition: 0.5s;
}

.submit__btn:hover {
    background-color: rgb(9, 9, 148);
}

/* Registration and Login Form Segment End */

/* Message Box Start */

.message__box .max__width {
    padding: 0;
    border: 0;
    border-radius: 10px;
    overflow: hidden;
    margin: 40px auto;
    display: flex;
    background: #fff;
    height: 75vh;
}

.message__box aside {
    padding: 20px;
    min-width: 350px;
    margin-left: 0;
    margin-top: 0;
    overflow-y: auto;
    background: #fff;
}

.message__box aside ul li {
    margin: 5px 0;
}

.message__box aside ul li a {
    display: flex;
    align-items: center;
    background: #eee;
    padding: 10px;
    border: 0;
    border-radius: 10px;
    transition: 0.4s;
}

.message__box aside ul li a:hover,
.message__box aside ul li a.active {
    background: gray;
}

.message__box aside ul li a:hover h2,
.message__box aside ul li a.active h2 {
    color: #fff;
}

.message__box aside ul li a img {
    width: 45px;
    height: 45px;
    border: 0;
    border-radius: 50%;
}

.message__box aside ul li a h2 {
    margin-left: 10px;
    color: gray;
}

.message__field {
    width: 100%;
    display: flex;
    flex-direction: column;
}

.message__field header {
    width: 100%;
    background: #fff;
    padding: 10px 0;
}

.message__field header a {
    display: flex;
    align-items: center;
    padding: 10px;
    background: #eee;
    border: 0;
    border-radius: 10px;
    width: 40%;
    margin-left: 15px;
    transition: 0.4s;
}

.message__field header a:hover {
    background: gray;
}

.message__field header a:hover h2 {
    color: #fff;
}

.message__field header a img {
    width: 40px;
    height: 40px;
    border: 0;
    border-radius: 50%;
}

.message__field header a h2 {
    margin-left: 10px;
    color: gray;
}

.all__messages {
    padding: 10px;
    background: lightpink;
    height: 100%;
    overflow-y: auto;
}

.all__messages ul li {
    display: flex;
    align-items: center;
}

.all__messages ul li img {
    width: 35px;
    height: 35px;
    border: 0;
    border-radius: 50%;
}

.all__messages ul li span {
    display: inline-block;
    font-size: 14px;
    padding: 10px;
    border: 0;
    border-radius: 15px;
    background: blue;
    color: #fff;
    margin: 2px 0;
    max-width: 300px;
    line-height: 17px;
    font-weight: 600;
}

.all__messages ul li.left span {
    margin-left: 8px;
    border-bottom-left-radius: 0;
}

.all__messages ul li.right span {
    margin-right: 8px;
    border-bottom-right-radius: 0;
    background: #eee;
    color: #111;
    margin-left: auto;
}

.message__send input:not(.msg__send) {
    width: 90%;
    margin: 10px 0;
    font-size: 16px;
    border: 2px solid gray;
    font-weight: 500;
    border-radius: 4px;
    padding: 4px 0 4px 12px;
}

.msg__send {
    font-size: 16px;
    padding: 5px 14px;
    font-weight: 600;
    border: 0;
    border-radius: 6px;
    background: green;
    color: #fff;
    cursor: pointer;
    transition: 0.4s;
}

.msg__send:hover {
    background: red;
}

.no__msg {
    text-align: center;
    font-size: 40px;
    margin-top: 15%;
    opacity: 0.5;
}

/* Message Box End */


/* Post Action Start */

.post__actions {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-top: 2px solid gray;
}

.post__action {
    font-size: 26px;
    flex-basis: 30%;
    padding: 6px 0;
    text-align: center;
    cursor: pointer;
    border: 0;
    border-radius: 20px;
    transition: 0.4s;
}

.post__action:hover {
    background: gray;
}


/* Post Action End */


/* Comment Section Start */

.comment__section {
    width: 100%;
    display: none;
}

.comment a {
    text-decoration: none;
    color: #111;
}

.comment_active {
    display: block;
}

.commentbtn_active,
.like_active {
    background: #000;
    color: #fff;
}

.comment__input__box {
    display: flex;
    align-items: center;
    text-align: center;
    margin: 0 20px;
    padding: 10px 0;
    padding-bottom: 20px;
    position: relative;
}

.comment__input__box::after {
    content: '';
    position: absolute;
    width: 100%;
    height: 1px;
    background: black;
    bottom: 0;
}

.comment__input {
    width: 100%;
    font-size: 16px;
    padding: 4px 0 4px 12px;
    border: 2px solid gray;
    border-radius: 10px;
}

.comment__btn {
    font-size: 16px;
    padding: 6px 15px;
    border: 0;
    border-radius: 4px;
    background: green;
    color: #fff;
    margin-left: 10px;
    cursor: pointer;
    font-weight: 600;
    transition: 0.5s;
}

.comment__btn:hover {
    background: darkgreen;
}
.comments {
    max-width: 80%;
}

.comment {
    padding: 10px;
    margin: 2px 0;
    display: flex;
    align-items: center;
    margin-left: 10px;
}

.comments img {
    width: 35px;
    height: 35px;
    border: 0;
    border-radius: 50%;
}

.comment__info {
    margin-left: 10px;
}

.comment__info span {
    display: inline-block;
    font-size: 14px;
    font-weight: 600;
    color: gray;
    margin-left: 4px;
}

/* Comment Section End */









    </style>
</head>
<body>
    
</body>
</html>