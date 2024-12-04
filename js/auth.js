// <!--112550003 李昀祐 第五次作業 11/17 112550003 Yun-Yu, Lee The Fifth Homework 11/17 -->
// document.getElementById('login-btn').addEventListener('click', () => openModal('login-modal'));
// document.getElementById('register-btn').addEventListener('click', () => openModal('register-modal'));

// function openModal(modalId) {
//     document.getElementById(modalId).style.display = 'flex';
// }

// function closeModal(modalId) {
//     document.getElementById(modalId).style.display = 'none';
// }

// document.addEventListener('DOMContentLoaded', () => {
// // 處理 Login 提交
//     document.getElementById('login-submit').addEventListener('click', async () => {
//         const username = document.getElementById('login-username').value;
//         const password = document.getElementById('login-password').value;

//         if (!username || !password) {
//             alert("Please enter both username and password.");
//             return;
//         }

//         try {
//             const response = await fetch('php/auth/login.php', {
//                 method: 'POST',
//                 headers: { 'Content-Type': 'application/json' },
//                 body: JSON.stringify({ username, password })
//             });
//             const result = await response.json();
//             alert(result.message);

//             if (result.success) {
//                 window.location.href = 'game.php'; // 跳轉到遊戲頁面
//             }
//         } catch (error) {
//             console.error("Login error:", error);
//         }
//     });

//     // 處理 Register 提交
//     document.getElementById('register-submit').addEventListener('click', async () => {
//         const username = document.getElementById('register-username').value;
//         const password = document.getElementById('register-password').value;

//         if (!username || !password) {
//             alert("Please enter both username and password.");
//             return;
//         }

//         try {
//             const response = await fetch('php/auth/register.php', {
//                 method: 'POST',
//                 headers: { 'Content-Type': 'application/json' },
//                 body: JSON.stringify({ username, password })
//             });
//             const result = await response.json();
//             alert(result.message);

//             if (result.success) {
//                 closeModal('register-modal');
//             }
//         } catch (error) {
//             console.error("Register error:", error);
//         }
//     });
// });