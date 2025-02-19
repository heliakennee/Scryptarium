window.onload = function () {

    lst = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    function b_to_10(b,n) {
        if (n.length == 1) {
            return lst.indexOf(n[0]);
        } else {
            return b_to_10(b,n.slice(1)) + Math.pow(b ,n.length-1) * lst.indexOf(n[0]);
             
        }
    }
    function _10_to_b(b,n) {
        if (Math.trunc(n/b) == 0) {
            return lst[n%b];
        } else {
            return _10_to_b(b,Math.trunc(n/b)) + lst[n%b];
        }
    }

    function b_to_b(d,a,n) {
        return _10_to_b(a,b_to_10(d,n));
    }

    function liste(n) {
        if (Math.trunc(n/10) == 0) {
            return [n];
        } else {
            return liste(Math.trunc(n/10)).concat([n % 10]);
        }
    }

    function somme(n) {
        if (n<10) {
            return n ** 2;
        } else {
            return (n % 10) ** 2 + somme(Math.trunc(n / 10));
        }
    }

    function heureux(n) {
        try {
            if (somme(n) == 1) {
                return true;
            } else {
                return heureux(somme(n));
            }
        } catch {
            return false
        }
    }

    function syracuse(u) {
        if (u == 1) {
            return [1];
        } else {
            if (u%2==0) {
                u=Math.trunc(u/2);
            } else {
                u=3*u+1;
            }
            return [u].concat(syracuse(u));
        }
    }

	function estpremier(nb) {
            // Vérifie si l'entrée est valide
            if (isNaN(nb) || nb < 2 || !Number.isInteger(nb)) {
                return false
            }

            // Vérifie si le nombre est premier
            for (let i = 2; i <= Math.sqrt(nb); i++) {
                if (nb % i === 0) {
                    return false
                }
            }

            return true
        }

    function decomposer(n, index = 0) {
        console.log(index);
        if (n/index === 1 || n === 0 ) {
            return [index];
        } else if (n%index === 0  && estpremier(index)) {
            return [index].concat(decomposer(n/index,index));
        } else {
            return decomposer(n,index+1);
        }
    }
        
    function euclide(l,f) {
        if (isNaN(l) && isNaN(f) && l == 0 && f == 0) { 
            return "Attention: risque de division par 0";
        }

        maxi = Math.max(l,f);
        mini = Math.min(l,f);     
        if (maxi % mini == 0) {
            alert(parseInt(mini));
            return;
        } else {
            return euclide(mini,maxi%mini);
        }
    }

    function soustraction(l,f) {
        if (l-f == 0) {
            return l;
        } else { 
            return soustraction(Math.abs(l-f),Math.min(l,f));   
        }
    }
    
    function modulo1() {
        lst = [];
        for (let i = 0; i <= 100; i ++) {
            if ((i**3 + 3*i -10) % 13 == 0) {
                lst.push(i);
            }
        }
        return lst;
    }

    function motif(ch) {
        let n = 0;
        let seq = "";
        const choices = ['P', 'F'];
    
        while (!seq.includes(ch)) {
            n++;
            seq += choices[Math.floor(Math.random() * choices.length)];
        }
        return [n, seq];
    }

    function moy(ch) {
        let s =0;
        for (i=0;i<1000;i++) {
            s += motif(ch)[0];
        }
        return s/1000;
    }

    function comp(motif1, motif2) {
        let n = 0;
        let seq = "";
        const choices = ['P', 'F'];
    
        while (!seq.includes(motif1) && !seq.includes(motif2)) {
            n++;
            seq += choices[Math.floor(Math.random() * choices.length)];
        }
        return seq.includes(motif1) ? 1 : 0;
    }
    
    function probabilite(k,motif1,motif2) {
        let s = 0;
        for (let i = 0; i < k; i++) {
            s += comp(motif1, motif2);
        }
        return [(100 - (s * 100 / k)) + "%", (s * 100 / k) + "%"];
    }
    

    const b_to_10btn = document.getElementById("b_to_10");
    const _10_to_bbtn = document.getElementById("_10_to_b");
    const b_to_bbtn = document.getElementById("b_to_b");
    const listebtn = document.getElementById("liste");
    const sommebtn = document.getElementById("somme");
    const heureuxbtn = document.getElementById("heureux");
    const syracusebtn = document.getElementById("syracuse");
    const estpremierbtn = document.getElementById("estpremier");
    const decomposerbtn = document.getElementById("decomposer");
    const euclidebtn = document.getElementById("euclide");
    const soustractionbtn = document.getElementById("soustraction");
    const modulo1btn = document.getElementById("modulo1");
    const PPFbtn = document.getElementById('PPF');
    const PPFmoybtn = document.getElementById('PPFmoy');
    const FPPbtn = document.getElementById('FPP');
    const FPPmoybtn = document.getElementById('FPPmoy');
    const compbtn = document.getElementById('comparaison');
    const probbtn = document.getElementById('probabilite');

    if (b_to_10btn) {
        b_to_10btn.addEventListener("click", () => {
            const nombre = prompt("Entrez un nombre:");
            const base = prompt("Entrez la base du nombre:");
            alert(b_to_10(Number(base), nombre));
        });
    }

    if (_10_to_bbtn) {
        _10_to_bbtn.addEventListener("click", () => {
            const nombre = prompt("Entrez un nombre:");
            const base = prompt("Entrez la base dans laquelle convertir:");
            alert(_10_to_b(Number(base), nombre));
        });
    }

    if (b_to_bbtn) {
        b_to_bbtn.addEventListener("click", () => {
            const nombre = prompt("Entrez un nombre:");
            const basea = prompt("Entrez la base du nombre:");
            const baseb = prompt("Entrez la base dans laquelle convertir:");
            alert(b_to_b(Number(basea), Number(baseb), nombre));
        });
    }

    if (listebtn) {
        listebtn.addEventListener("click", () => {
            const nombre = prompt("Entrez un nombre:");
            alert(liste(Number(nombre)));
        });
    }

    if (sommebtn) {
        sommebtn.addEventListener("click", () => {
            const nombre = prompt("Entrez un nombre:");
            alert(somme(Number(nombre)));
        });
    }

    if (heureuxbtn) {
        heureuxbtn.addEventListener("click", () => {
            const nombre = prompt("Entrez un nombre:");
            alert(heureux(Number(nombre)));
        });
    }

    if (syracusebtn) {
        syracusebtn.addEventListener("click", () => {
            const nombre = prompt("Entrez un nombre:");
            alert(syracuse(Number(nombre)));
        });
    }

    if (estpremierbtn) {
        estpremierbtn.addEventListener("click", () => {
            const input = prompt("Entrez un nombre entier supérieur à 1:");
            alert(estpremier(Number(input))); // La fonction estpremier utilise déjà alert
        });
    }

    if (decomposerbtn) {
        decomposerbtn.addEventListener("click", () => {
            const nombre = prompt("Entrez un nombre:");
            alert(decomposer(Number(nombre)));
        });
    }

    if (euclidebtn) {
        euclidebtn.addEventListener("click", () => {
            const euclide1 = prompt("Entrez un premier nombre entier:");
            const euclide2 = prompt("Entrez un second nombre entier:");
            euclide(Number(euclide1), Number(euclide2)); // La fonction euclide utilise déjà alert
        });
    }

    if (soustractionbtn) {
        soustractionbtn.addEventListener("click", () => {
            const soustraction1 = prompt("Entrez un premier nombre entier:");
            const soustraction2 = prompt("Entrez un second nombre entier:");
            alert(soustraction(Number(soustraction1), Number(soustraction2))); // La fonction utilise alert
        });
    }

    if (modulo1btn) {
        modulo1btn.addEventListener("click", () => {
            alert(modulo1()); // La fonction utilise alert
        });
    }
    if (PPFbtn) {
        PPFbtn.addEventListener("click", () => {
            const ppf = prompt("Entrez le motif étudié:");
            alert(motif(ppf.toUpperCase()));
        })
    }
    if (PPFmoybtn) {
        PPFmoybtn.addEventListener("click", () => {
            const ppfmoy = prompt("Entrez le motif étudié:");
            alert(moy(ppfmoy.toUpperCase()));
        })
    }
    if (FPPbtn) {
        FPPbtn.addEventListener("click", () => {
            const fpp = prompt("Entrez le motif étudié:");
            alert(motif(fpp.toUpperCase()));
        })
    }
    if (FPPmoybtn) {
        FPPmoybtn.addEventListener("click", () => {
            const fppmoy = prompt("Entrez le motif étudié:");
            alert(moy(fppmoy.toUpperCase()));
        })
    }
    if (compbtn) {
        compbtn.addEventListener("click", () => {
            const comp1 = prompt("Entrez le premier motif");
            const comp2 = prompt("Entrez le second motif");
            alert(comp(comp1.toUpperCase(),comp2.toUpperCase()));
        })
    }
    if (probbtn) {
        probbtn.addEventListener("click", () => {
            const k = prompt("Combien d'essaies faire ?" ) 
            const prob1 = prompt('Quel est le premier motif ?')
            const prob2 = prompt('Quel est le second motif ?')
            alert(probabilite(k,prob1.toUpperCase(),prob2.toUpperCase()));
        })
    }
}