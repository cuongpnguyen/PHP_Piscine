window.onload = () =>
{
    var list = document.getElementById("ft_list");
    var button = document.getElementById("bgnBtn");

    button.addEventListener('click', (_) => {
        var new_entry = window.prompt("Please enter new tasks", "To Do");
        //var cookieArr;
        if(new_entry && new_entry.trim() != '')
        {
            var cookieArr = getCookie('tasks') || [];
            if (cookieArr.indexOf(new_entry) != -1)
                return window.alert('exists');
            cookieArr.push(new_entry);
            setCookie('tasks', cookieArr);
            addTask(new_entry);
        }
    });

    function addTask(task)
    {
    var node = document.createElement('div');
    node.classList.add('task');
    node.innerText = task;
    node.setAttribute('data-content', task);
    node.addEventListener('click', () => removeTask(node));
    list.prepend(node);
    }

    function removeTask(task)
    {
        if(window.confirm('Are you sure?'))
        {
            var cookieArr = getCookie("tasks") || [];
            var i = cookieArr.indexOf(task.innerHTML);
            if (i != -1)
            {
                cookieArr.splice(i, 1);
                console.log(cookieArr);
                setCookie('tasks', cookieArr);
            }  
            task.remove();
        }
    }

    function buildUI()
    {
        var cookieArr = getCookie("tasks") || [];
        cookieArr.forEach((task) => addTask(task));
    }
    buildUI();
}

function getCookie(cname = null) {
    var decodedCookie = null;
    try
    {
        decodedCookie = JSON.parse(decodeURIComponent(document.cookie));
    }
    catch{
        decodedCookie = null;
    }
    if(!cname)
        return (decodedCookie);
    if (decodedCookie)
        return decodedCookie[cname];
    else
        return null;
}

function setCookie(key, val)
{
    var cookie = getCookie(null) || {};
    cookie[key] = val;
    var str = JSON.stringify(cookie);
    document.cookie = encodeURIComponent(str);
    return (cookie);
}