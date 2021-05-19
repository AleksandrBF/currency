<?php

class MainController extends AbstractController
{
    protected $title;
    protected $meta_desc;
    protected $meta_key;
    protected $type_page;

    public function __construct()
    {
        parent::__construct(new View(DIR_TMPL));
    }

    public function error()
    {
        parent::error();
        $this->title = 'Страница не найдена !!!';
        $this->meta_desc = 'Запрошеная страница не существует.';
        $this->meta_key = 'страница не найдена, страница не существует, 404';

        $content = $this->view->render('404', [], true);
        $this->render($content);
    }

    public function index()
    {
        $this->title = 'Конвертер валют';
        $this->meta_desc = 'Конвертер валют';
        $this->meta_key = 'конвертер валют';
        $this->type_page = 'home';
        $params = [];

        $settings = $this->settings->getSettings();
        $params['currencies'] = $settings['currencies'];

        if (isset($_POST['submit'])){
            $quantity = intval($_POST['quantity']);
            $quantity = $quantity > 0 ? $quantity : 1;

            $selectedCurrency = [$_POST['currencyFrom'], $_POST['currencyTo']];

            $active_currency = new Currency();
            $active_currency = $active_currency->getCurrency($selectedCurrency);

            if (empty(array_diff_key(array_flip($selectedCurrency), $active_currency))) {
                $sum = round((round((1/$active_currency[$_POST['currencyTo']]['rate']), 5)*$active_currency[$_POST['currencyFrom']]['rate'])*$quantity, 2);

                $params['result'] = [
                    'quantity' => $quantity,
                    'from' => $_POST['currencyFrom'],
                    'to' => $_POST['currencyTo'],
                    'sum' => $sum,
                ];

                $strDb = $quantity . ' ' . $_POST['currencyFrom'] . ' = ' . $sum . ' ' . $_POST['currencyTo'];
                R::exec("INSERT INTO `queries` SET `result` = ?, `date` = NOW()", [$strDb]);
            } else {
                $params['msg'] = [
                    'success' => false,
                    'text' => 'Одной из валют нет в базе'
                ];
            }
        }

        $content = $this->view->render('converter', $params, true);
        $this->render($content);
    }

    public function history()
    {
        $this->title = 'История запросов';
        $this->meta_desc = 'История запросов';
        $this->meta_key = 'история запросов';
        $this->type_page = 'history';
        $params = [];

        $settings = $this->settings->getSettings();

        $queries = R::getAll("SELECT `result`, `date` FROM `queries` WHERE 1 ORDER BY `id` DESC LIMIT ?", [$settings['itemPage']]);

        if (!empty($queries)) {
            $params['queries'] = $queries;
        } else {
            $params['msg'] = [
                'success' => false,
                'text' => 'Запросов пока нет !'
            ];
        }

        $content = $this->view->render('history', $params, true);
        $this->render($content);
    }

    public function setting()
    {
        $this->title = 'Настройки';
        $this->meta_desc = 'Настройки';
        $this->meta_key = 'настройки';
        $this->type_page = 'setting';

        $params = [];

        $currency = new Currency();
        $params['allCurrency'] = $currency->getCurrencies();

        if (isset($_POST['submit'])) {
            $msg = [
                'success' => false,
                'text' => 'Что-то пошло не так настройки не сохранены !'
            ];

            $this->settings->setSettings('itemPage', ((int)$_POST['itemPage'] > 0) ? (int)$_POST['itemPage'] : 5);
            $this->settings->setSettings('currencies', ($_POST['currencies'] ?? []));

            if ($this->settings->save()) {
                $msg = [
                    'success' => true,
                    'text' => 'Изменения в настройках успешно внесены !'
                ];
            }
            $params['msg'] = $msg;
        }

        $settings = $this->settings->getSettings();

        $params['selectedCurrency'] = $settings['currencies'] ?? [];
        $params['itemPage'] = $settings['itemPage'];

        $content = $this->view->render('setting', $params, true);
        $this->render($content);
    }

    protected function render($content)
    {
        $params = [];
        $params['title'] = $this->title;
        $params['meta_desc'] = $this->meta_desc;
        $params['meta_key'] = $this->meta_key;
        $params['type_page'] = $this->type_page;
        $params['content'] = $content;

        $this->view->render(MAIN_LAYOUT, $params);
    }
}