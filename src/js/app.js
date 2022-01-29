document.addEventListener("DOMContentLoaded", () => {

    dark_mode();

    if(location.href === "http://localhost/home.php"){
        add_task();
        edit_task();
        cancel_edit_task();
        pomodoro();
        validate_inputs();
    }

});


const dark_mode = () => {
    const system_dark_mode = window.matchMedia('(prefers-color-scheme: dark)');

    // console.log(prefiereDarkMode.matches);

    if(system_dark_mode.matches) {
        document.body.classList.add('dark-mode');
    } else {
        document.body.classList.remove('dark-mode');
    }

    // if the user has changed the system preferences
    system_dark_mode.addEventListener('change', function() {
        if(system_dark_mode.matches) {
            document.body.classList.add('dark-mode');
        } else {
            document.body.classList.remove('dark-mode');
        }
    });
}


const create_alert = (type, message, container) => {
    const div = document.createElement("DIV");
    div.classList.add("alert");
    div.classList.add(`${type}`);

    const p = document.createElement("P");
    p.textContent = message;

    div.appendChild(p);

    if(!document.querySelector(".alert")){
        container.appendChild(div);

        setTimeout(() => {
            container.removeChild(div);
        }, 2000);
    }

}

const validate_inputs = () => {

    const inputs_title = document.querySelectorAll(".input-title");

    const inputs_file = document.querySelectorAll(".input-file");

    const btns_save = document.querySelectorAll(".save");

    btns_save.forEach(btn_save => {
        btn_save.classList.add("btn-disabled");
        btn_save.disabled = true;
    });

    inputs_title.forEach(input_title => {

        input_title.addEventListener("input", (e) => {

            const fieldset_input_title = input_title.parentNode;
            const form_input_title = fieldset_input_title.parentNode;

            if((e.target.value).length < 4 || (e.target.value).length > 45){
                create_alert("error", "Minimo 4 caracteres, Maximo 45.", form_input_title);
                btns_save.forEach(btn_save => {
                    btn_save.classList.add("btn-disabled");
                    btn_save.disabled = true;
                });
            }
            else{
                btns_save.forEach(btn_save => {
                    btn_save.classList.remove("btn-disabled");
                    btn_save.disabled = false;
                });
            }

        });

    });

    inputs_file.forEach(input_file => {

        // 4 mb
        const size = 1000 * 4000;
        // console.log(size/1000000);

        input_file.addEventListener("input", (e) => {

            const fieldset_input_file = input_file.parentNode;
            const form_input_file = fieldset_input_file.parentNode;
            
            const image_size = e.target.files[0].size;
            // console.log(image_size);

            if(image_size > size){
                create_alert("error", "La imagen debe pesar menos de 5mb", form_input_file);
                
                e.target.value = "";
            }

        });

    });

}

const notification = (message) => {
    if(!Notification){
        alert("Notificaciones no soportadas. Para una mejor experiencia actualiza tu navegador.");
        return;
    }

    if(Notification.permission !== "granted"){
        Notification.requestPermission();
    }
    else{
        const notification = new Notification(message, {
            body: "Productivity +"
        });
    }
}

function getRandomNumber(min, max) {
    let step1 = max - min + 1;
    let step2 = Math.random() * step1;
    let result = Math.floor(step2) + min;
    return result;
}

const pomodoro = () => {
    // Disabled the tasks
    const container_tasks = document.querySelector(".tasks");
    const disabled_task = document.createElement("DIV");

    container_tasks.appendChild(disabled_task);

    // Pomodoro state

    pomodoro_state = document.querySelector(".pomodoro-state");

    // Create a message
    pomodoro_message = document.createElement("SPAN");
    pomodoro_state.appendChild(pomodoro_message);


    // Timer

    const btn_start = document.getElementById("start-pomodoro");

    const timer = document.getElementById("timer");

    // Building the content of the div for when the counter starts
    const div_pomodoro = document.querySelector(".pomodoro-start");
    const h3 = document.createElement("H3");
    h3.classList.add("title");
    h3.textContent = "Parar";

    // Building the content of the div for when the counter stop
    const h3_pomodoro = document.createElement("H3");
    h3_pomodoro.classList.add("title");
    h3_pomodoro.textContent = "Pomodoro.";
    const span_pomodoro = document.createElement("SPAN");
    span_pomodoro.textContent = "25:5";
    
    btn_start.addEventListener("click", () => {

        // Disabled the tasks
        container_tasks.classList.add("position-relative");
        disabled_task.classList.add("position-absolute");
        disabled_task.classList.add("disabled");

        pomodoro_message.innerHTML = "¡Concentrate!";
        

        btn_start.classList.add("hidden");

        div_pomodoro.innerHTML = "";
        div_pomodoro.classList.add("btn-red-block");
        div_pomodoro.appendChild(h3);

        let second = 0;
        let minute = 0;
        let break_time = false;

        const cont = setInterval( () => {

            // Formating the timer
            if(minute < 10){
                timer.innerHTML = `0${minute}:`;
            }
            else{
                timer.innerHTML = `${minute}:`;
            }

            if(second < 10){
                timer.innerHTML += `0${second}`;
            }
            else{
                timer.innerHTML += `${second}`;
            }

            // Logic of timer
            second += 1;
            if(second > 59){
                minute += 1;
                second = 0;
            }

            // If minutes is 25 and not is time of break
            if(minute > 24 && !break_time){
                // Reset timer
                minute = 0;
                second = 0;

                // When minutes is 25 is time of break
                break_time = true;

                notification("¡Descanso!");
                pomodoro_message.innerHTML = "¡Descanso!";
            }

            // In the break, if when minutes is 5 and is time of break
            if(minute > 4 && break_time){
                // Reset timer
                minute = 0;
                second = 0;

                // When minutes is 5 in time of break, the break is ended
                break_time = false;

                notification("A trabajar!");
                pomodoro_message.innerHTML = "¡Concentrate!";
            }

        }, 1000);

        // Create a button for stop the timer
        div_pomodoro.addEventListener("click", () => {
            // Enabled the tasks
            container_tasks.classList.remove("position-relative");
            disabled_task.classList.remove("position-absolute");
            disabled_task.classList.remove("disabled");

            // Reset the pomodoro message
            pomodoro_message.innerHTML = "";

            // Close the timer
            clearInterval(cont);

            // Reset timer
            timer.innerHTML = "00:00";

            div_pomodoro.innerHTML = "";
            div_pomodoro.classList.remove("btn-red-block");

            // Default content
            div_pomodoro.appendChild(h3_pomodoro);
            div_pomodoro.appendChild(span_pomodoro);

            btn_start.classList.remove("hidden");
        });

    });

}

const cancel_edit_task = () => {
    btn_cancel = document.querySelectorAll(".cancel-edit");

    btn_cancel.forEach(btn_cancel => {
        btn_cancel.addEventListener("click", (e) => {
            e.preventDefault();

            const task = document.getElementById(e.target.id);

            const edit_task = document.getElementById(`${e.target.id}-edit`);

            task.classList.remove("hidden");
            edit_task.classList.add("hidden");

        });
    });
}

const edit_task = () => {
    btn_edit = document.querySelectorAll(".edit");

    btn_edit.forEach(btn_edit => {
        btn_edit.addEventListener("click", (e) => {
            const task = document.getElementById(e.target.id);
            const edit_task = document.getElementById(`${e.target.id}-edit`);

            task.classList.add("hidden");
            edit_task.classList.remove("hidden");
        });
    });

}

const add_task = () => {
    const btn_add = document.querySelector("#btn-add");
    btn_add.addEventListener("click", create_popup);
}

const create_popup = () => {
    const body = document.querySelector("body");
    body.classList.add("fixed");
    
    const overlay = document.querySelector(".overlay");
    overlay.classList.remove("hidden");

    const btn_cancel = document.querySelector(".cancel");
    btn_cancel.addEventListener("click", (e) => {
        e.preventDefault();
        overlay.classList.add("hidden");
        body.classList.remove("fixed");
    });
}