color0 = "#eee"; //font color
color1 = "#525CEB"; //main color
color2 = "#363b91"; //main color
color4 = "#181b47"; //background color
color5 = "#525CEB"; //footer color
color10 = "#0007";


body=document.getElementsByTagName("body")[0];
body.style = `
    --color0:${color0};
    --color1:${color1};
    --color2:${color2};
    --color4:${color4};
    --color5:${color5};
    --color10:${color10};
    `;

var style = document.createElement("style");
style.type = "text/css";



document.getElementsByTagName("head")[0].appendChild(style);



