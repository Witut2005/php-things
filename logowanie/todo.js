window.onload = () => {

    loadedTasks = $('.loaded-item');

    for (let i = 0; i < loadedTasks.length; i++) {

        console.log(loadedTasks[i].innerHTML);
        loadedTasks[i].style.display = 'none';

        const TaskDiv = document.createElement('div');
        TaskDiv.setAttribute('class', 'Task');

        const TaskName = document.createElement('p');
        const DeleteButton = document.createElement('div');

        TaskName.innerHTML = loadedTasks[i].innerHTML;
        const DeleteText = document.createElement('p');
        DeleteText.innerHTML = 'Delete';
        DeleteButton.append(DeleteText);

        TaskDiv.append(TaskName);
        TaskDiv.append(DeleteButton);

        $('#TaskContainer').append(TaskDiv);

        DeleteButton.addEventListener('click', () => {

            const DataToSend = new FormData();
            DataToSend.append('action', 'delete');
            DataToSend.append('taskName', TaskName.innerHTML);

            const xhttp = new XMLHttpRequest();
            xhttp.open('POST', './update_tasks.php');
            xhttp.send(DataToSend);

            TaskDiv.remove();
        });

    }


}

$('#AddTask').on('click', () => {

    const TaskDiv = document.createElement('div');
    TaskDiv.setAttribute('class', 'Task');

    const TaskName = document.createElement('p');
    const DeleteButton = document.createElement('div');

    TaskName.innerHTML = $('div > input').val();
    const DeleteText = document.createElement('p');
    DeleteText.innerHTML = 'Delete';
    DeleteButton.append(DeleteText);

    TaskDiv.append(TaskName);
    TaskDiv.append(DeleteButton);

    $('#TaskContainer').append(TaskDiv);

    DeleteButton.addEventListener('click', () => {

        const DataToSend = new FormData();
        DataToSend.append('action', 'delete');
        DataToSend.append('taskName', TaskName.innerHTML);

        const xhttp = new XMLHttpRequest();
        xhttp.open('POST', './update_tasks.php');
        xhttp.send(DataToSend);

        TaskDiv.remove();
    });


    const DataToSend = new FormData();
    DataToSend.append('action', 'update');
    DataToSend.append('taskName', TaskName.innerHTML);

    const xhttp = new XMLHttpRequest();

    xhttp.open('POST', './update_tasks.php');
    xhttp.send(DataToSend);

    $('div > input').val('');


});