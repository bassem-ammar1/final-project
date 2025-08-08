//define tags  needed for the script
const task=document.getElementById("task_input");
let taskList=document.getElementById("task_list");
let body=document.getElementById("body");
let initialText = document.getElementById("initial_text");
//functions

// function used to get value of total tasks and completed tasks
function updateTaskCounts() {
    //get the value of total tasks
    const total = taskList.getElementsByTagName("li").length;
    //get the value of completed tasks, by query that will iterate over the list see if checkbox
    //is checked, if it is then it is a completed task and we add 1 to the total then repeat until the total length is reached
    const completed = taskList.querySelectorAll('input[type="checkbox"]:checked').length;
    document.getElementById("total_tasks").textContent = total;
    document.getElementById("completed_tasks").textContent = completed;
}



function displayTask() {
    //validating that the user have inserted a task into task box
    if (task.value !== "") {
        if(initialText) {
            initialText.remove();} 
        //list to store checkbox, text,buttons in it     
        let li = document.createElement("li");
        li.className = "task-item";
        let checkbox = document.createElement("input");
        checkbox.className = "task-checkbox";
        checkbox.type = "checkbox";
        checkbox.addEventListener("change",updateTaskCounts);

        // Create a text node to store the task value        
        let textNode = document.createTextNode(" " + task.value + " ");   
        // Delete button
        let deleteButton = document.createElement("button");
        deleteButton.textContent = "🗑️";
        deleteButton.className = "delete-btn";
        //edit button
        let editButton = document.createElement("button");
        editButton.textContent = "✏️";
        editButton.className = "edit-btn";
        // span here is used to manipulate the text size w.r.t container(li)
        let textSpan = document.createElement("span");
        textSpan.className = "task-text";
        
        
        
        //what function is supposed to do:
        deleteButton.addEventListener("click", function() {
        li.remove();
        // Update task counts after hitting delete button
        updateTaskCounts(); 
        });
                 
        editButton.addEventListener("click", function () {
        //check if textbox already exist to avoid more than textbox when hitting edit twice   
        if(!li.querySelector("input[type='text']")) { 
            let newTextHolder = document.createElement("input");
            newTextHolder.type = "text";
            li.appendChild(newTextHolder);
            newTextHolder.addEventListener("change", function () {
            //rassigning the text content of node we defined    
            textNode.textContent = " "+newTextHolder.value + " ";
            //removing the text holder for the edit when everthing is done 
            li.removeChild(newTextHolder); 
            });
        }
        });
     //putting them all in a container which is the list   
     li.appendChild(checkbox);
     textSpan.appendChild(textNode);
     li.appendChild(textSpan);
     li.appendChild(editButton);
     li.appendChild(deleteButton);
    //dislay the task at browser
     taskList.appendChild(li);
     //the mother input to add a task needes to be empty after adding a task
     task.value = ""; 
     //Update task counts after adding a new task
     updateTaskCounts();         
    }
}

function toggleTheme() {
    if (body.classList.contains("dark-theme")) {
        body.classList.remove("dark-theme");
        body.classList.add("light-theme");
    } else {
        body.classList.remove("light-theme");
        body.classList.add("dark-theme");
    }
    // Update the icon based on the new theme
    changeIcon(); 
}

function changeIcon() {
    let themeIcon = document.getElementById("theme_icon");
    let body = document.getElementById("body");
    // Set icon based on the current theme
    if (body.classList.contains("dark-theme")) {
        themeIcon.textContent = "☀️";
    } else {
        themeIcon.textContent = "🌙";
    }
}