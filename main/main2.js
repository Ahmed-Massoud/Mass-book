    

bannerNum = 7;
bannerSpeed = 30;
recentNum = 7;
   



var keyFrames = `
 @keyframes slidy { 
        
            0%,${(0.5 * 86) / bannerNum}%{
                transform : translateX(0%);
            }            
            ${(0.5 * 86) / bannerNum + 2}%,${(1.5 * 86) / bannerNum + 2}%{
                transform : translateX(-12.5%);
            }
            ${(1.5 * 86) / bannerNum + 4}%,${(2.5 * 86) / bannerNum + 4}%{
                transform : translateX(-25%);
            }
            ${(2.5 * 86) / bannerNum + 6}%,${(3.5 * 86) / bannerNum + 6}%{
                transform : translateX(-37.5%);
            }
            ${(3.5 * 86) / bannerNum + 8}%,${(4.5 * 86) / bannerNum + 8}%{
                transform : translateX(-50%);
            }
            ${(4.5 * 86) / bannerNum + 10}%,${(5.5 * 86) / bannerNum + 10}%{
                transform : translateX(-62.5%);
            }
            ${(5.5 * 86) / bannerNum + 12}%,${(6.5 * 86) / bannerNum + 12}%{
                transform : translateX(-75%);
            }
            ${(6.5 * 86) / bannerNum + 14}%,100%{
                transform : translateX(-87.5%);
            }
            
        }
            
         
                
                    `;
style.innerHTML+= keyFrames;



    




    bigDiv = document.querySelector(".bigDiv");
    bigDiv.style = `animation :${bannerSpeed}s slidy infinite;width:${
      (bannerNum + 1) * 100
    }%`;
  

    

    loader = document.querySelector(".loader");

    window.addEventListener("load", function () {
      loader.style.display = "none";
      });    
