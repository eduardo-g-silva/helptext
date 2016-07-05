<?php

namespace app\controllers;

use common\models\LoginForm;
use app\models\ContactForm;
use app\models\PasswordResetRequestForm;
use app\models\ResetPasswordForm;
use app\models\SignupForm;
use Yii;
use yii\helpers\Markdown;
use yii\helpers\Url;
use yii\web\Controller;
use yii\filters\AccessControl;

/**
 * Site controller.
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['error'],
                    ],
                    [
                        'allow' => true,
                        'matchCallback' => function ($rule, $action) {
                            return \Yii::$app->user->can(
                                $this->module->id.'_'.$this->id.'_'.$action->id,
                                ['route' => true]
                            );
                        },
                    ],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Renders the start page
     * @return string
     */
    public function actionIndex()
    {
        // SEO meta tags
        $this->view->registerMetaTag(
            [
                'name'    => 'keywords',
                'content' => 'HelpText+, Open-ecommerce.org, software, charities, social project, london'
            ],
            'keywords'
        );
        $this->view->registerMetaTag(
            [
                'name'    => 'description',
                'content' => 'HelpText+ Text Managment system for the Destitute Asylum Seekers Drop-In.'
            ],
            'description'
        );
        return $this->render('index');
    }
    
    
    /**
     * Renders the contact page
     * @return string
     */
    public function actionContactus()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->sendEmail(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');
            return $this->refresh();
        } else {
            return $this->render('contactus', [
                'model' => $model,
            ]);
        }
    }    

    /**
     * Renders the testing page
     * @return string
     */
    public function actionTesting()
    {
        $this->layout = 'container';
        return $this->render('testing');
    } 

    
    
}
