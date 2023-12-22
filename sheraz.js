function getReport() {
    var name = document.forum.getElementById('name1').value;
    var eng = document.forum.getElementById('eng').value;
    var mat = document.forum.getElementById('mathss').value;
    var phy = document.forum.getElementById('physs').value;

    var totalmarks = eng + mat + phy;

    var percentage = (totalmarks / 3) * 100;

    document.getElementById('resname').innerHTML = name;
    document.getElementById('getavg').innerHTML = percentage;
}