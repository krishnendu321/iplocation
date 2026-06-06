<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">

<title>Location Sharing</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background:#0f172a;
    color:white;
    display:flex;
    justify-content:center;
    align-items:center;
    min-height:100vh;
}

.card{
    width:500px;
    border-radius:20px;
}

</style>

</head>
<body>

<div class="card p-4 shadow">

<h2>Share Your Location</h2>

<p>
This application will request your location through your browser.
You can allow or deny access.
</p>

<button class="btn btn-primary" onclick="shareLocation()">
Share Location
</button>

<div id="status" class="mt-3"></div>

</div>

<script>

function shareLocation()
{
    if(!navigator.geolocation)
    {
        document.getElementById("status").innerHTML =
            "Geolocation not supported.";
        return;
    }

    navigator.geolocation.getCurrentPosition(
        sendLocation,
        showError,
        {
            enableHighAccuracy:true
        }
    );
}

function sendLocation(pos)
{
    let lat = pos.coords.latitude;
    let lng = pos.coords.longitude;

    fetch("save.php",{
        method:"POST",
        headers:{
            "Content-Type":
            "application/x-www-form-urlencoded"
        },
        body:
        "lat="+encodeURIComponent(lat)+
        "&lng="+encodeURIComponent(lng)
    })
    .then(r=>r.text())
    .then(data=>{
        document.getElementById("status").innerHTML=data;
    });
}

function showError()
{
    document.getElementById("status").innerHTML =
    "Location permission denied.";
}

</script>

</body>
</html>