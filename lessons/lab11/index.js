setTimeout(function() {
        let p = document.getElementById('test');
        let button = document.createElement('button');
        button.setAttribute('class', 'btn btn-danger');
        button.setAttribute('id', 'button1');
        button.innerText = 'Button 1';
        button.onclick = test;
        p.appendChild(button);
    }, 1000);
    function test() {
        console.log('hello');
    }
    
    
// Даны два целых числа A и B (A < B). Найти сумму квадратов всех целых 
// чисел от A до B включительно. (20 баллов - 10 баллов)

let a = 5;
let b = 10;
let sum = 0;

for (let i = a; i <= b; i ++) {
    sum += i**2;
}

console.log(sum);


// Даны два целых числа A и B (A < B). Вывести в порядке возрастания все целые числа, 
// расположенные между A и B (включая сами числа A и B), а также количество N этих чисел. (20 баллов - 10 баллов)

// let a = 4;
// let b = 8;
// let count = 0;

// for (let i = a; i <= b; i++) {
//     console.log(i);
//     count ++;
// }

// console.log(count);

// Даны целые положительные числа A и B (A < B). Найти сумму всех нечетных чисел (30 баллов - 15 баллов)

// let a = 1;
// let b = 10;
// let sum_odd = 0;

// for (let i = a; i <= b; i++) {
//     if (i % 2 == 1) {
//         sum_odd += i;
//     }
// }

console.log(sum_odd);

// Даны целые положительные числа A и B (A < B). Вывести все четные числа от A до B. (30 баллов - 15 баллов) 

// let a = 1;
// let b = 10;

// for (let i = a; i <= b; i++) {
//     if (i % 2 == 0) {
//         console.log(i);
//     }
// }