<div class="container">
    <h1 class="title">Создание аккаунта</h1>
    <form action="{{ route('account') }}" enctype="multipart/form-data" method="post">
        @csrf
        <label for="firstName">Имя<br/>
            <input class="text" type="text" name="firstName" placeholder="Введите Имя" id="firstName" required/>
        </label><br/>
        <label for="lastName">Фамилия<br/>
            <input class="text" type="text" name="lastName" placeholder="Введите фамилию" id="lastName" required/>
        </label><br/>
        <label for="dateBirth">Дата рождения<br/>
            <input class="text" type="date" value="0000-00-00" name="dateBirth" id="dateBirth" required/></label><br/>
        <label for="maritalStatus">Семейное положение
            <select name="maritalStatus" id="maritalStatus">
                <option value="">-- Выберите статус --</option>
                <option value="холост">Холост</option>
                <option value="женат">Женат</option>
                <option value="не замужем">Не замужем</option>
                <option value="замужем">Замужем</option>
                <option value="в активном поиске">В активном поиске</option>
                <option value="есть парень">Есть парень</option>
                <option value="есть девушка">Есть девушка</option>
            </select>
        </label><br/>
        <label for="locality">Населенный пункт<br/>
            <input class="text" type="text" name="locality" placeholder="Введите населенный пункт" id="locality"
                   required/> </label><br/>
        <label for="career">Род деятельности<br/>
            <input class="text" type="text" name="career" placeholder="Ваш род деятельности" id="career" required/>
        </label><br/>
        <label for="hobby">Хобби<br/>
            <input class="text" type="text" name="hobby" placeholder="Ваше хобби" id="hobby" required/> </label><br/>
        <label for="file">Фотография<br/>
            <input type="file" name="file" accept="image/*" multiple /></label><br/>
        <button type="submit" id="submit">Создать</button>
    </form>
</div>

<style>
    /* Importing Roboto Font */
    @import url("https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap");

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        position: relative;
        font-family: "Roboto", sans-serif;
        font-size: 15px;
        color: white;
        height: fit-content;
        background: linear-gradient(
            rgba(0, 71, 255, 1) 0%,
            rgb(9, 31, 121) 35%,
            rgb(0, 5, 36) 100%
        );
        background-repeat: no-repeat;
    }

    .container {
        background-color: rgba(255, 255, 255, 0.06);
        margin: 0 auto;
        margin-top: 80px;
        text-align: center;
        padding: 50px 0;
        width: 480px;
        height: auto;
        border-radius: 15px;
        backdrop-filter: blur(100px);
        border: 2px solid lightgrey;
    }

    label,
    .signInDiv {
        display: inherit;
        text-align: left;
        margin-left: 15px;
        font-size: 15px;
        font-weight: 500;
    }

    .title {
        margin-bottom: 35px;
        font-size: 3.2rem;
    }

    #submit {
        background-color: transparent;
        border: 1px solid lightgrey;
        color: white;
        transition: background-color 0.4s ease-in-out, color 0.4s ease-in-out,
        border 0.4s ease-in-out;
        cursor: pointer;
        border-radius: 15px;
        height: 45px;
        width: 60%;
        font-weight: 600;
        font-size: 1.8rem;
        margin-bottom: 10px;
    }

    #submit:hover {
        border: 10px ridge grey;
    }

    #submit:active {
        border-style: groove;
    }

    .text {
        height: 2em;
        width: 60%;
        border-radius: 7px;
        border: 1px solid lightgrey;
        background-color: transparent;
        color: white;
    }

    .text::placeholder {
        color: rgb(176, 173, 173);
        font-size: 1.1em;
        text-indent: 0.2em;
    }

    #privacyLink {
        color: white;
        text-decoration: underline;
    }

    #privacyCheck {
        width: 1.3em;
        height: 1.3em;
        background-color: transparent;
        border-radius: 50%;
        vertical-align: middle;
        border: 1px solid #8d8d8d;
        appearance: none;
        -webkit-appearance: none;
        outline: none;
        cursor: pointer;
        margin-right: 0.3rem;
    }

    #privacyCheck:checked {
        background-color: white;
    }

</style>
