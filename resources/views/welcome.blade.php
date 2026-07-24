<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskFlow — Ваше пространство для задач и привычек</title>
    
    @vite(['resources/css/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, sans-serif;
            color: #212529;
            overflow-x: hidden;
        }

        .hero-section {
            padding: 80px 0 60px;
            background: linear-gradient(135deg, #f0f4ff 0%, #f8f9fa 100%);
        }

        .gradient-text {
            background: linear-gradient(135deg, #0d6efd 0%, #6610f2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .feature-card {
            transition: transform 0.25s ease, box-shadow 0.25s ease;
            border: 1px solid rgba(0,0,0,0.05);
        }
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 1rem 3rem rgba(0,0,0,.08) !important;
        }

        .icon-box {
            width: 56px;
            height: 56px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 16px;
        }

        /* --- ПРЕМИАЛЬНЫЙ ДИЗАЙН ПРЕВЬЮ (MOCKUP) --- */
        .app-window {
            background: #ffffff;
            border-radius: 20px;
            border: 1px solid rgba(0,0,0,0.04);
            box-shadow: 0 25px 50px -12px rgba(13, 110, 253, 0.15), 0 0 0 1px rgba(0,0,0,0.02);
            overflow: hidden;
            backdrop-filter: blur(10px);
        }

        .app-header {
            background: rgba(248, 249, 250, 0.8);
            border-bottom: 1px solid rgba(0,0,0,0.05);
            padding: 14px 20px;
        }

        .mac-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            display: inline-block;
        }

        .ui-card {
            background: #ffffff;
            border: 1px solid rgba(0,0,0,0.03);
            border-radius: 14px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
        }
        
        .ui-card:hover {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.08), 0 4px 6px -2px rgba(0, 0, 0, 0.04);
            transform: translateY(-2px);
        }

        .ui-card.done {
            background: #f8f9fa;
            opacity: 0.8;
        }
        
        .ui-card.done h6 {
            text-decoration: line-through;
            color: #6c757d;
        }

        .task-checkbox {
            width: 22px;
            height: 22px;
            border: 2px solid #cbd5e1;
            border-radius: 6px; /* Слегка скругленный квадрат вместо круга для разнообразия */
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
        }
        
        .task-checkbox.checked {
            background-color: #0d6efd;
            border-color: #0d6efd;
            color: white;
        }

        .habit-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 6px;
            margin-top: 12px;
        }

        .habit-day {
            aspect-ratio: 1;
            border-radius: 8px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            font-size: 0.65rem;
            font-weight: 700;
            transition: transform 0.2s;
        }
        
        .habit-day.done { background-color: #10b981; color: white; box-shadow: 0 2px 5px rgba(16, 185, 129, 0.3); }
        .habit-day.missed { background-color: #f1f5f9; color: #94a3b8; }
        .habit-day.today { border: 2px dashed #0d6efd; background-color: transparent; color: #0d6efd; }
        
        .user-avatar {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            border: 2px solid #fff;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-white py-3 border-bottom sticky-top" data-aos="fade-down" data-aos-duration="600">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary d-flex align-items-center gap-2 fs-4" href="#">
                <i class="bi bi-check2-square fs-3"></i> TaskFlow
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#landingNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="landingNavbar">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0 fw-medium">
                    <li class="nav-item"><a class="nav-link px-3" href="#features">Возможности</a></li>
                    <li class="nav-item"><a class="nav-link px-3" href="#habits">Трекер привычек</a></li>
                    <li class="nav-item"><a class="nav-link px-3" href="#reviews">Отзывы</a></li>
                </ul>
                <div class="d-flex align-items-center gap-2">
                    <a href="{{ route('login') }}" class="btn btn-link text-decoration-none text-dark fw-semibold">Войти</a>
                    <a href="{{ route('register') }}" class="btn btn-primary rounded-pill px-4 fw-semibold shadow-sm">Зарегистрироваться</a>
                </div>
            </div>
        </div>
    </nav>

    <section class="hero-section position-relative overflow-hidden">
        <div class="container">
            <div class="row align-items-center gy-5">
                <div class="col-lg-6" data-aos="fade-right" data-aos-duration="800">
                    <span class="badge bg-primary-subtle text-primary rounded-pill px-3 py-2 mb-3 fw-semibold fs-6">
                        🚀 Умный планер нового поколения
                    </span>
                    <h1 class="display-4 fw-bold lh-sm mb-3">
                        Органайзер, который <span class="gradient-text">наводит порядок</span> в делах и привычках
                    </h1>
                    <p class="lead text-secondary mb-4">
                        Планируйте сложные проекты, отслеживайте регулярные привычки и настраивайте идеальную рабочую атмосферу под себя.
                    </p>
                    <div class="d-flex flex-sm-row flex-column gap-3 mb-4">
                        <a href="{{ route('register') }}" class="btn btn-primary btn-lg rounded-pill px-4 py-3 fw-semibold shadow">
                            Начать бесплатно <i class="bi bi-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000">
                    <div class="app-window position-relative">
                        
                        <div class="app-header d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-2">
                                <span class="mac-dot" style="background-color: #ff5f56;"></span>
                                <span class="mac-dot" style="background-color: #ffbd2e;"></span>
                                <span class="mac-dot" style="background-color: #27c93f;"></span>
                            </div>
                            {{-- <div class="fw-semibold text-secondary small" style="letter-spacing: 0.5px;">Мой Дашборд</div>
                            <div>
                                <img src="https://ui-avatars.com/api/?name=User&background=0d6efd&color=fff" alt="User" class="rounded-circle" style="width: 28px; height: 28px;">
                            </div> --}}
                        </div>

                        <div class="p-4" style="background-color: #f8fafc;">
                            
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="fw-bold text-dark mb-0 fs-5">Задачи на сегодня</h6>
                                <span class="badge bg-primary rounded-pill">3 осталось</span>
                            </div>

                            <div class="ui-card p-3 border-start border-4 border-danger mb-3 position-relative">
                                <div class="d-flex align-items-start gap-3">
                                    <div class="task-checkbox mt-1">
                                        <i class="bi bi-check opacity-0"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="fw-bold mb-1 text-dark">Подготовить отчет по проекту Laravel</h6>
                                        <div class="d-flex align-items-center gap-3 text-secondary small mb-2">
                                            <span class="text-danger fw-semibold"><i class="bi bi-clock-fill me-1"></i> 14:00</span>
                                            <span><i class="bi bi-diagram-2 me-1"></i> 2/3 подзадач</span>
                                        </div>
                                        <div class="d-flex gap-2 align-items-center">
                                            <span class="badge bg-danger-subtle text-danger px-2 py-1">🔥 Срочно</span>
                                            <span class="badge bg-primary-subtle text-primary px-2 py-1">💼 Работа</span>
                                            <div class="ms-auto d-flex">
                                                <img src="https://ui-avatars.com/api/?name=A&background=random" class="user-avatar" style="z-index: 3;" alt="">
                                                <img src="https://ui-avatars.com/api/?name=B&background=random" class="user-avatar ms-n2" style="z-index: 2; margin-left: -8px;" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="ui-card p-3 border-start border-4 border-warning mb-3">
                                <div class="d-flex align-items-start gap-3">
                                    <div class="task-checkbox mt-1">
                                        <i class="bi bi-check opacity-0"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="fw-semibold mb-1 text-dark">Сверстать Landing Page</h6>
                                        <div class="d-flex align-items-center gap-3 text-secondary small mb-2">
                                            <span><i class="bi bi-clock me-1"></i> Сегодня, 18:00</span>
                                        </div>
                                        <div class="d-flex gap-2">
                                            <span class="badge bg-warning-subtle text-warning-emphasis px-2 py-1">🎨 Дизайн</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="ui-card done p-3 border-start border-4 border-success mb-4">
                                <div class="d-flex align-items-start gap-3">
                                    <div class="task-checkbox checked mt-1">
                                        <i class="bi bi-check fs-5"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="fw-semibold mb-1">Обновить зависимости в composer.json</h6>
                                        <div class="d-flex gap-2 mt-2">
                                            <span class="badge bg-success-subtle text-success px-2 py-1"><i class="bi bi-check-all"></i> Готово</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="fw-bold text-dark mb-0 fs-5">Трекер привычек</h6>
                            </div>

                            <div class="ui-card p-3 mb-3 border-0">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="bg-success-subtle text-success rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 42px; height: 42px; font-size: 1.4rem;">
                                            🏃
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-0 text-dark">Утренняя пробежка</h6>
                                            <small class="text-secondary fw-medium" style="font-size: 0.75rem;">Ежедневная цель</small>
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <div class="badge bg-orange text-white rounded-pill px-2 py-1 shadow-sm" style="background: linear-gradient(45deg, #f97316, #fb923c);">
                                            🔥 12 дней
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="habit-grid mt-3">
                                    <div class="habit-day done"><span>Пн</span><i class="bi bi-check"></i></div>
                                    <div class="habit-day done"><span>Вт</span><i class="bi bi-check"></i></div>
                                    <div class="habit-day done"><span>Ср</span><i class="bi bi-check"></i></div>
                                    <div class="habit-day done"><span>Чт</span><i class="bi bi-check"></i></div>
                                    <div class="habit-day missed"><span>Пт</span><i class="bi bi-dash"></i></div>
                                    <div class="habit-day done"><span>Сб</span><i class="bi bi-check"></i></div>
                                    <div class="habit-day today"><span>Вс</span><i class="bi bi-circle"></i></div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="features" class="py-5 bg-white">
        <div class="container py-4">
            <div class="text-center mx-auto mb-5" data-aos="fade-up" style="max-width: 600px;">
                <span class="text-primary fw-bold text-uppercase tracking-wider small">Мощный функционал</span>
                <h2 class="fw-bold display-6 mt-2">Всё необходимое в одной вкладке</h2>
            </div>
            <div class="row g-4">
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="card h-100 rounded-4 p-4 feature-card bg-white shadow-sm">
                        <div class="icon-box bg-primary-subtle text-primary mb-3"><i class="bi bi-diagram-3 fs-3"></i></div>
                        <h4 class="fw-bold h5">Вложенные задачи</h4>
                        <p class="text-muted mb-0">Разбивайте крупные цели на понятные подзадачи для проектов любой сложности.</p>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="card h-100 rounded-4 p-4 feature-card bg-white shadow-sm">
                        <div class="icon-box bg-warning-subtle text-warning mb-3"><i class="bi bi-fire fs-3"></i></div>
                        <h4 class="fw-bold h5">Трекер привычек</h4>
                        <p class="text-muted mb-0">Закрепляйте полезные привычки. Удобная сетка и система серий мотивируют не сдаваться.</p>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="card h-100 rounded-4 p-4 feature-card bg-white shadow-sm">
                        <div class="icon-box bg-success-subtle text-success mb-3"><i class="bi bi-palette fs-3"></i></div>
                        <h4 class="fw-bold h5">Темы оформления</h4>
                        <p class="text-muted mb-0">Настраивайте цвета интерфейса под свое настроение. Настройки сохраняются навсегда.</p>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="card h-100 rounded-4 p-4 feature-card bg-white shadow-sm">
                        <div class="icon-box bg-info-subtle text-info mb-3">
                            <i class="bi bi-calendar-week fs-3"></i>
                        </div>
                        <h4 class="fw-bold h5">Умный календарь</h4>
                        <p class="text-muted mb-0">Компактный сетчатый виджет показывает дни с запланированными задачами. Быстро ориентируйтесь в расписании на месяц.</p>
                    </div>
                </div>

                <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="card h-100 rounded-4 p-4 feature-card bg-white shadow-sm">
                        <div class="icon-box bg-danger-subtle text-danger mb-3">
                            <i class="bi bi-exclamation-triangle fs-3"></i>
                        </div>
                        <h4 class="fw-bold h5">Приоритеты и дедлайны</h4>
                        <p class="text-muted mb-0">Сортировка по степени важности автоматически поднимает срочные и приоритетные задачи в верх списка.</p>
                    </div>
                </div>

                <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="card h-100 rounded-4 p-4 feature-card bg-white shadow-sm">
                        <div class="icon-box bg-purple-subtle text-secondary mb-3" style="background: #e2d9f3; color: #6f42c1;">
                            <i class="bi bi-phone fs-3"></i>
                        </div>
                        <h4 class="fw-bold h5">100% Адаптивность</h4>
                        <p class="text-muted mb-0">Удобная работа на любых устройствах. Мобильное offcanvas-меню превращает сайдбар в удобную выкатывающуюся панель.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="habits" class="py-5 bg-light">
        <div class="container py-4">
            <div class="row align-items-center gy-5">
                <div class="col-lg-6 order-lg-2" data-aos="fade-left">
                    <div class="p-4 bg-white rounded-4 shadow-sm border">
                        <h3 class="fw-bold mb-4">Как TaskFlow меняет продуктивность:</h3>
                        <div class="d-flex gap-3 mb-3">
                            <div class="text-danger fs-4"><i class="bi bi-x-circle-fill"></i></div>
                            <div>
                                <h6 class="fw-bold mb-1">Раньше: Хаос в заметках</h6>
                                <p class="text-muted small mb-0">Задачи на стикерах, привычки в другом приложении.</p>
                            </div>
                        </div>
                        <hr class="my-3">
                        <div class="d-flex gap-3">
                            <div class="text-success fs-4"><i class="bi bi-check-circle-fill"></i></div>
                            <div>
                                <h6 class="fw-bold mb-1">С TaskFlow: Полный контроль</h6>
                                <p class="text-muted small mb-0">Всё на одном экране: список приоритетов и встроенный календарь.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 order-lg-1" data-aos="fade-right">
                    <span class="text-primary fw-bold text-uppercase tracking-wider small">Дисциплина без стресса</span>
                    <h2 class="fw-bold display-6 mt-2 mb-3">Превращайте цели в ежедневные системные действия</h2>
                    <p class="text-secondary lead fs-6 mb-4">
                        Большинство To-Do сервисов фокуссируются только на разовых делах. TaskFlow помогает вырабатывать постоянные привычки благодаря наглядным прогресс-барам и геймификации.
                    </p>
                    <a href="{{ route('register') }}" class="btn btn-primary rounded-pill px-4 py-2 fw-semibold">
                        Присоединиться сейчас
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section id="reviews" class="py-5 bg-white">
        <div class="container py-4">
            <div class="text-center mx-auto mb-5" data-aos="fade-up" style="max-width: 600px;">
                <h2 class="fw-bold display-6">Что говорят пользователи</h2>
                <p class="text-muted">Отзывы тех, кто уже навел порядок в своих ежедневных делах.</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4" data-aos="zoom-in" data-aos-delay="100">
                    <div class="p-4 rounded-4 bg-light h-100 d-flex flex-column justify-content-between">
                        <p class="text-secondary mb-3">«Наконец-то нашел сервис, где привычки не оторваны от основных задач. Недельная сетка выполненных дней очень мотивирует!»</p>
                        <div class="d-flex align-items-center gap-3">
                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 42px; height: 42px;">АМ</div>
                            <div>
                                <div class="fw-bold">Алексей М.</div>
                                <small class="text-muted">Frontend разработчик</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" data-aos="zoom-in" data-aos-delay="200">
                    <div class="p-4 rounded-4 bg-light h-100 d-flex flex-column justify-content-between">
                        <p class="text-secondary mb-3">«Очень понравился минималистичный дизайн без лишнего мусора. Вложенные подзадачи — просто спасение для моих проектов.»</p>
                        <div class="d-flex align-items-center gap-3">
                            <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 42px; height: 42px;">ЕК</div>
                            <div>
                                <div class="fw-bold">Елена К.</div>
                                <small class="text-muted">Проектный менеджер</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" data-aos="zoom-in" data-aos-delay="300">
                    <div class="p-4 rounded-4 bg-light h-100 d-flex flex-column justify-content-between">
                        <p class="text-secondary mb-3">«Возможность меня тему оформления под себя — супер приятная мелочь. Пользуюсь каждый день уже третий месяц.»</p>
                        <div class="d-flex align-items-center gap-3">
                            <div class="bg-purple text-white rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 42px; height: 42px; background: #6f42c1;">ДП</div>
                            <div>
                                <div class="fw-bold">Дмитрий П.</div>
                                <small class="text-muted">Фрилансер</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container" data-aos="zoom-in-up" data-aos-duration="800">
            <div class="cta-banner bg-primary text-white rounded-4 p-5 text-center shadow-lg position-relative overflow-hidden">
                <div class="position-relative z-1 max-width-600 mx-auto py-3">
                    <h2 class="fw-bold display-6 mb-3">Готовы организовать свой день?</h2>
                    <p class="lead mb-4 text-white-50">Создайте бесплатный аккаунт за 1 минуту и получите доступ ко всем возможностям сервиса прямо сейчас.</p>
                    <a href="{{ route('register') }}" class="btn btn-light btn-lg rounded-pill px-5 py-3 fw-bold text-primary shadow">
                        Создать аккаунт бесплатно
                    </a>
                </div>
            </div>
        </div>
    </section>

    <footer class="py-4 bg-white border-top">
        <div class="container d-flex flex-column flex-md-row align-items-center justify-content-between gap-3">
            <div class="d-flex align-items-center gap-2 text-muted small">
                <i class="bi bi-check2-square text-primary fs-5"></i>
                <span>© {{ date('Y') }} TaskFlow. Все права защищены.</span>
            </div>
            <div class="d-flex gap-4 small text-muted">
                <a href="#" class="text-decoration-none text-muted">Конфиденциальность</a>
                <a href="#" class="text-decoration-none text-muted">Условия использования</a>
                <a href="#" class="text-decoration-none text-muted">Поддержка</a>
            </div>
        </div>
    </footer>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            once: true,
            offset: 80,
            duration: 600,
            easing: 'ease-out-cubic',
        });
    </script>

</body>
</html>