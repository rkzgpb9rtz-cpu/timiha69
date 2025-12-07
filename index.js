// Функция для переключения темы
function toggleTheme() {
    const body = document.body;
    const themeBtn = document.getElementById('themeToggle');
    const themeIcon = themeBtn.querySelector('.theme-icon');
    const themeText = themeBtn.querySelector('.theme-text');
    
    if (body.classList.contains('dark-theme')) {
        // Переключаем на светлую тему
        body.classList.remove('dark-theme');
        themeIcon.textContent = '🌙';
        localStorage.setItem('theme', 'light');
    } else {
        // Переключаем на темную тему
        body.classList.add('dark-theme');
        themeIcon.textContent = '☀️';
        localStorage.setItem('theme', 'dark');
    }
}

// Инициализация темы при загрузке страницы
document.addEventListener('DOMContentLoaded', function() {
    const savedTheme = localStorage.getItem('theme');
    const themeBtn = document.getElementById('themeToggle');
    
    if (savedTheme === 'dark') {
        document.body.classList.add('dark-theme');
        themeBtn.querySelector('.theme-icon').textContent = '☀️';
    }
    
    // Добавляем обработчик события на кнопку
    themeBtn.addEventListener('click', toggleTheme);
});