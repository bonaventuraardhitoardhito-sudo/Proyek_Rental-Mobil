<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include "config/koneksi.php";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Rental Mobil Platform</title>

    <link rel="stylesheet" href="style.css">

    <style>

        /* =========================================================
           GLOBAL
        ========================================================= */

        html {
            scroll-behavior: smooth;
        }

        * {
            box-sizing: border-box;
        }

        body.home-page {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            color: #ffffff;

            background:
                radial-gradient(
                    circle at 10% 20%,
                    rgba(100, 88, 110, 0.20),
                    transparent 30%
                ),
                radial-gradient(
                    circle at 90% 80%,
                    rgba(82, 74, 100, 0.18),
                    transparent 30%
                ),
                linear-gradient(
                    120deg,
                    #383232,
                    #3e3b3b,
                    #0b080b,
                    #4f4c4c
                );

            background-size: 180% 180%;
            animation: homeBackground 15s ease infinite;

            min-height: 100vh;
            overflow-x: hidden;
        }

        @keyframes homeBackground {

            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }

        }

        a {
            text-decoration: none;
        }


        /* =========================================================
           NAVBAR
        ========================================================= */

        .home-navbar {
            position: sticky;
            top: 0;
            z-index: 1000;

            width: 100%;

            display: flex;
            align-items: center;
            justify-content: space-between;

            padding: 18px 6%;

            background: rgba(15, 13, 16, 0.78);

            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);

            border-bottom: 1px solid rgba(255, 255, 255, 0.08);

            transition: 0.3s ease;
        }

        .home-navbar:hover {
            background: rgba(15, 13, 16, 0.90);
        }

        .home-logo {
            display: flex;
            align-items: center;
            gap: 10px;

            color: white;

            font-size: 20px;
            font-weight: 800;
            letter-spacing: 1.5px;
        }

        .home-logo-icon {
            width: 38px;
            height: 38px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 10px;

            background:
                linear-gradient(
                    135deg,
                    #e0e0e6,
                    #47454c
                );

            color: #17151a;

            font-size: 18px;

            box-shadow:
                0 5px 20px rgba(0, 0, 0, 0.30);
        }

        .home-menu {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .home-menu a {
            position: relative;

            padding: 10px 15px;

            color: #d7d5d9;

            font-size: 14px;
            font-weight: 600;

            border-radius: 8px;

            transition:
                color 0.3s ease,
                background 0.3s ease,
                transform 0.3s ease;
        }

        .home-menu a:hover {
            color: white;

            background: rgba(255, 255, 255, 0.08);

            transform: translateY(-2px);
        }

        .home-menu a.active {
            color: white;

            background: rgba(255, 255, 255, 0.10);
        }


        /* =========================================================
           HERO
        ========================================================= */

        .home-hero {
            position: relative;

            min-height: 650px;

            display: flex;
            align-items: center;

            padding: 80px 7% 70px;

            overflow: hidden;
        }

        .hero-glow-one,
        .hero-glow-two,
        .hero-glow-three {
            position: absolute;

            border-radius: 50%;

            filter: blur(3px);

            pointer-events: none;
        }

        .hero-glow-one {
            width: 300px;
            height: 300px;

            background: rgba(126, 105, 150, 0.10);

            top: 60px;
            right: -100px;

            animation: floatingGlow 8s ease-in-out infinite;
        }

        .hero-glow-two {
            width: 180px;
            height: 180px;

            background: rgba(255, 255, 255, 0.05);

            left: -50px;
            bottom: 50px;

            animation: floatingGlow 6s ease-in-out infinite reverse;
        }

        .hero-glow-three {
            width: 120px;
            height: 120px;

            background: rgba(110, 90, 130, 0.10);

            right: 42%;
            top: 10%;

            animation: floatingGlow 7s ease-in-out infinite;
        }

        @keyframes floatingGlow {

            0%,
            100% {
                transform: translateY(0) scale(1);
            }

            50% {
                transform: translateY(-25px) scale(1.08);
            }

        }

        .hero-content {
            position: relative;
            z-index: 2;

            width: 55%;

            animation: heroTextIn 1s ease forwards;
        }

        @keyframes heroTextIn {

            from {
                opacity: 0;
                transform: translateY(35px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }

        }

        .hero-label {
            display: inline-flex;
            align-items: center;
            gap: 8px;

            padding: 8px 14px;

            border: 1px solid rgba(255, 255, 255, 0.15);

            border-radius: 50px;

            background: rgba(255, 255, 255, 0.06);

            color: #d8d4df;

            font-size: 12px;
            font-weight: 700;

            letter-spacing: 1px;

            margin-bottom: 20px;
        }

        .hero-label-dot {
            width: 7px;
            height: 7px;

            border-radius: 50%;

            background: #c9c2d3;

            box-shadow:
                0 0 12px rgba(220, 210, 235, 0.8);

            animation: dotPulse 2s infinite;
        }

        @keyframes dotPulse {

            0%,
            100% {
                transform: scale(1);
                opacity: 1;
            }

            50% {
                transform: scale(1.5);
                opacity: 0.6;
            }

        }

        .hero-content h1 {
            margin: 0 0 20px;

            font-size: clamp(42px, 5vw, 72px);

            line-height: 1.05;

            letter-spacing: -2px;

            color: #ffffff;
        }

        .hero-content h1 span {
            background:
                linear-gradient(
                    135deg,
                    #ffffff,
                    #bdb9c5,
                    #736b7d
                );

            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;

            background-clip: text;
        }

        .hero-content p {
            max-width: 650px;

            margin: 0 0 30px;

            color: #c5c1c8;

            font-size: 16px;

            line-height: 1.8;
        }

        .hero-buttons {
            display: flex;
            align-items: center;
            gap: 14px;

            flex-wrap: wrap;
        }

        .hero-primary-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;

            min-width: 155px;

            padding: 14px 22px;

            border-radius: 10px;

            background:
                linear-gradient(
                    135deg,
                    #e0e0e6,
                    #47454c
                );

            color: #ffffff;

            font-size: 14px;
            font-weight: 700;

            box-shadow:
                0 10px 30px rgba(0, 0, 0, 0.30);

            transition:
                transform 0.3s ease,
                box-shadow 0.3s ease;
        }

        .hero-primary-btn:hover {
            transform: translateY(-4px);

            box-shadow:
                0 15px 35px rgba(0, 0, 0, 0.45);
        }

        .hero-secondary-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            padding: 13px 22px;

            border: 1px solid rgba(255, 255, 255, 0.18);

            border-radius: 10px;

            background: rgba(255, 255, 255, 0.04);

            color: #e4e1e7;

            font-size: 14px;
            font-weight: 600;

            transition: 0.3s ease;
        }

        .hero-secondary-btn:hover {
            background: rgba(255, 255, 255, 0.10);

            transform: translateY(-3px);
        }


        /* =========================================================
           CSS CAR
        ========================================================= */

        .hero-car-area {
            position: absolute;

            z-index: 1;

            width: 43%;
            height: 350px;

            right: 3%;
            top: 50%;

            transform: translateY(-45%);

            display: flex;
            align-items: center;
            justify-content: center;

            animation: carAreaIn 1.2s ease forwards;
        }

        @keyframes carAreaIn {

            from {
                opacity: 0;
                transform: translate(40px, -40%);
            }

            to {
                opacity: 1;
                transform: translate(0, -45%);
            }

        }

        .car-shadow {
            position: absolute;

            bottom: 65px;

            width: 330px;
            height: 30px;

            border-radius: 50%;

            background: rgba(0, 0, 0, 0.55);

            filter: blur(10px);

            animation: shadowMove 2s ease-in-out infinite;
        }

        @keyframes shadowMove {

            0%,
            100% {
                transform: scaleX(1);
                opacity: 0.7;
            }

            50% {
                transform: scaleX(0.88);
                opacity: 0.45;
            }

        }

        .css-car {
            position: relative;

            width: 360px;
            height: 150px;

            animation: carFloat 3s ease-in-out infinite;
        }

        @keyframes carFloat {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-9px);
            }

        }

        .car-body {
            position: absolute;

            width: 350px;
            height: 85px;

            bottom: 30px;
            left: 5px;

            border-radius:
                80px
                35px
                20px
                20px;

            background:
                linear-gradient(
                    145deg,
                    #f0f0f2,
                    #a8a6ad,
                    #4b494f
                );

            box-shadow:
                inset 0 -10px 15px rgba(0, 0, 0, 0.25),
                0 20px 30px rgba(0, 0, 0, 0.35);
        }

        .car-window {
            position: absolute;

            width: 150px;
            height: 48px;

            top: -40px;
            left: 105px;

            background:
                linear-gradient(
                    135deg,
                    #3d3941,
                    #17141a
                );

            border-radius:
                45px
                20px
                5px
                5px;

            transform: skewX(-10deg);

            border: 2px solid rgba(255, 255, 255, 0.15);
        }

        .car-window::after {
            content: "";

            position: absolute;

            width: 2px;
            height: 42px;

            background: rgba(255, 255, 255, 0.12);

            left: 72px;
            top: 2px;
        }

        .car-light {
            position: absolute;

            width: 28px;
            height: 15px;

            right: 8px;
            top: 22px;

            border-radius: 50% 5px 5px 50%;

            background: #e5e2e7;

            box-shadow:
                0 0 15px rgba(255, 255, 255, 0.8);
        }

        .car-back-light {
            position: absolute;

            width: 18px;
            height: 14px;

            left: 8px;
            top: 24px;

            border-radius: 5px;

            background: #413b44;
        }

        .car-door {
            position: absolute;

            width: 85px;
            height: 52px;

            top: 14px;
            left: 155px;

            border-left: 1px solid rgba(0, 0, 0, 0.25);
            border-right: 1px solid rgba(0, 0, 0, 0.15);
        }

        .car-handle {
            position: absolute;

            width: 20px;
            height: 4px;

            border-radius: 10px;

            background: #38353b;

            top: 20px;
            left: 215px;
        }

        .car-wheel {
            position: absolute;

            width: 57px;
            height: 57px;

            bottom: 2px;

            border-radius: 50%;

            background:
                radial-gradient(
                    circle,
                    #c9c7cc 0 15%,
                    #28262b 16% 40%,
                    #0d0c0e 41% 100%
                );

            border: 5px solid #19171b;

            box-shadow:
                0 5px 10px rgba(0, 0, 0, 0.4);

            animation: wheelSpin 4s linear infinite;
        }

        .wheel-left {
            left: 45px;
        }

        .wheel-right {
            right: 45px;
        }

        @keyframes wheelSpin {

            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }

        }

        .road-line {
            position: absolute;

            width: 450px;
            height: 2px;

            bottom: 50px;

            background:
                repeating-linear-gradient(
                    90deg,
                    rgba(255,255,255,0.6) 0 45px,
                    transparent 45px 80px
                );

            animation: roadMove 1.8s linear infinite;
        }

        @keyframes roadMove {

            from {
                transform: translateX(0);
            }

            to {
                transform: translateX(-80px);
            }

        }


        /* =========================================================
           HERO STATS
        ========================================================= */

        .hero-stats {
            display: flex;

            gap: 35px;

            margin-top: 42px;

            flex-wrap: wrap;
        }

        .hero-stat {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .hero-stat strong {
            color: white;

            font-size: 22px;
        }

        .hero-stat span {
            color: #99959f;

            font-size: 12px;
        }


        /* =========================================================
           SECTION GLOBAL
        ========================================================= */

        .home-section {
            position: relative;

            padding: 100px 7%;
        }

        .section-heading {
            max-width: 700px;

            margin: 0 auto 55px;

            text-align: center;
        }

        .section-label {
            display: inline-block;

            margin-bottom: 12px;

            color: #aaa3b3;

            font-size: 12px;

            font-weight: 700;

            text-transform: uppercase;

            letter-spacing: 2px;
        }

        .section-heading h2 {
            margin: 0 0 15px;

            color: #ffffff;

            font-size: clamp(30px, 4vw, 44px);

            letter-spacing: -1px;
        }

        .section-heading p {
            margin: 0;

            color: #aaa7ae;

            font-size: 15px;

            line-height: 1.8;
        }


        /* =========================================================
           FEATURES
        ========================================================= */

        .features-section {
            background:
                linear-gradient(
                    180deg,
                    rgba(0, 0, 0, 0.08),
                    rgba(0, 0, 0, 0.25)
                );
        }

        .home-feature-grid {
            display: grid;

            grid-template-columns:
                repeat(4, 1fr);

            gap: 22px;

            max-width: 1250px;

            margin: auto;
        }

        .home-feature-card {
            position: relative;

            padding: 30px 25px;

            min-height: 230px;

            border-radius: 18px;

            background:
                linear-gradient(
                    145deg,
                    rgba(255, 255, 255, 0.09),
                    rgba(255, 255, 255, 0.035)
                );

            border: 1px solid rgba(255, 255, 255, 0.09);

            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);

            overflow: hidden;

            transition:
                transform 0.35s ease,
                border-color 0.35s ease,
                box-shadow 0.35s ease;
        }

        .home-feature-card::before {
            content: "";

            position: absolute;

            width: 100px;
            height: 100px;

            top: -50px;
            right: -50px;

            border-radius: 50%;

            background: rgba(142, 124, 160, 0.10);

            transition: 0.4s ease;
        }

        .home-feature-card:hover {
            transform: translateY(-10px);

            border-color:
                rgba(185, 174, 195, 0.28);

            box-shadow:
                0 20px 45px rgba(0, 0, 0, 0.25);
        }

        .home-feature-card:hover::before {
            transform: scale(2);
        }

        .feature-number {
            color: #77727e;

            font-size: 12px;

            font-weight: 700;

            margin-bottom: 20px;
        }

        .feature-icon {
            width: 52px;
            height: 52px;

            display: flex;
            align-items: center;
            justify-content: center;

            margin-bottom: 20px;

            border-radius: 14px;

            background:
                linear-gradient(
                    135deg,
                    #e0e0e6,
                    #47454c
                );

            color: #17151a;

            font-size: 22px;

            box-shadow:
                0 8px 20px rgba(0, 0, 0, 0.25);
        }

        .home-feature-card h3 {
            margin: 0 0 10px;

            color: white;

            font-size: 17px;
        }

        .home-feature-card p {
            margin: 0;

            color: #aaa7ae;

            font-size: 13px;

            line-height: 1.7;
        }


        /* =========================================================
           INFO STRIP
        ========================================================= */

        .info-strip {
            max-width: 1250px;

            margin: 0 auto;

            display: grid;

            grid-template-columns:
                repeat(3, 1fr);

            gap: 20px;
        }

        .info-box {
            display: flex;
            align-items: center;

            gap: 18px;

            padding: 25px;

            border-radius: 16px;

            background: rgba(255, 255, 255, 0.05);

            border: 1px solid rgba(255, 255, 255, 0.08);

            transition: 0.3s ease;
        }

        .info-box:hover {
            transform: translateY(-5px);

            background: rgba(255, 255, 255, 0.08);
        }

        .info-icon {
            width: 50px;
            height: 50px;

            flex-shrink: 0;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 50%;

            background: #27242a;

            font-size: 20px;
        }

        .info-box h3 {
            margin: 0 0 5px;

            font-size: 15px;
        }

        .info-box p {
            margin: 0;

            color: #99959f;

            font-size: 12px;

            line-height: 1.5;
        }


        /* =========================================================
           HOW IT WORKS
        ========================================================= */

        .steps-section {
            background:
                rgba(5, 4, 6, 0.25);
        }

        .steps {
            position: relative;

            max-width: 1100px;

            margin: auto;

            display: grid;

            grid-template-columns:
                repeat(4, 1fr);

            gap: 25px;
        }

        .steps::before {
            content: "";

            position: absolute;

            top: 35px;
            left: 12%;

            width: 76%;
            height: 1px;

            background:
                linear-gradient(
                    90deg,
                    transparent,
                    rgba(255, 255, 255, 0.20),
                    transparent
                );
        }

        .step {
            position: relative;

            text-align: center;

            z-index: 2;
        }

        .step-number {
            width: 70px;
            height: 70px;

            display: flex;
            align-items: center;
            justify-content: center;

            margin: 0 auto 22px;

            border-radius: 50%;

            background:
                linear-gradient(
                    135deg,
                    #e0e0e6,
                    #47454c
                );

            color: #18161b;

            font-size: 20px;

            font-weight: 800;

            border: 7px solid #211e23;

            box-shadow:
                0 0 0 1px rgba(255,255,255,0.08);
        }

        .step h3 {
            margin: 0 0 10px;

            font-size: 16px;
        }

        .step p {
            margin: 0;

            color: #99959f;

            font-size: 13px;

            line-height: 1.7;
        }


        /* =========================================================
           RENTAL INFORMATION
        ========================================================= */

        .rental-info {
            max-width: 1250px;

            margin: auto;

            display: grid;

            grid-template-columns: 1fr 1fr;

            gap: 25px;
        }

        .rental-panel {
            position: relative;

            padding: 35px;

            border-radius: 20px;

            background:
                linear-gradient(
                    145deg,
                    rgba(255, 255, 255, 0.09),
                    rgba(255, 255, 255, 0.025)
                );

            border: 1px solid rgba(255, 255, 255, 0.09);

            overflow: hidden;
        }

        .rental-panel::after {
            content: "";

            position: absolute;

            width: 200px;
            height: 200px;

            right: -100px;
            bottom: -100px;

            border-radius: 50%;

            background: rgba(111, 93, 128, 0.10);
        }

        .rental-panel h3 {
            margin: 0 0 18px;

            font-size: 21px;
        }

        .rental-panel > p {
            color: #aaa7ae;

            font-size: 13px;

            line-height: 1.8;
        }

        .rental-list {
            list-style: none;

            padding: 0;
            margin: 25px 0 0;
        }

        .rental-list li {
            display: flex;
            align-items: flex-start;

            gap: 12px;

            padding: 11px 0;

            color: #c6c3c9;

            font-size: 13px;

            border-bottom:
                1px solid rgba(255, 255, 255, 0.06);
        }

        .rental-list li:last-child {
            border-bottom: none;
        }

        .check {
            width: 20px;
            height: 20px;

            flex-shrink: 0;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 50%;

            background: rgba(255, 255, 255, 0.10);

            color: #e4e1e7;

            font-size: 11px;
        }


        /* =========================================================
           WHY US
        ========================================================= */

        .why-grid {
            max-width: 1250px;

            margin: auto;

            display: grid;

            grid-template-columns:
                repeat(3, 1fr);

            gap: 22px;
        }

        .why-card {
            padding: 30px;

            border-radius: 18px;

            background: rgba(255, 255, 255, 0.045);

            border:
                1px solid rgba(255, 255, 255, 0.07);

            transition: 0.3s ease;
        }

        .why-card:hover {
            background: rgba(255, 255, 255, 0.075);

            transform: translateY(-7px);
        }

        .why-card h3 {
            margin: 0 0 12px;

            font-size: 17px;
        }

        .why-card p {
            margin: 0;

            color: #9d99a2;

            font-size: 13px;

            line-height: 1.8;
        }


        /* =========================================================
           FAQ
        ========================================================= */

        .faq-container {
            max-width: 850px;

            margin: auto;
        }

        .faq-item {
            margin-bottom: 12px;

            border:
                1px solid rgba(255, 255, 255, 0.08);

            border-radius: 13px;

            background:
                rgba(255, 255, 255, 0.045);

            overflow: hidden;
        }

        .faq-question {
            width: 100%;

            display: flex;
            align-items: center;
            justify-content: space-between;

            padding: 20px;

            border: none;

            background: transparent;

            color: white;

            text-align: left;

            font-size: 14px;
            font-weight: 600;

            cursor: pointer;
        }

        .faq-plus {
            width: 25px;
            height: 25px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 50%;

            background: rgba(255, 255, 255, 0.08);

            transition: 0.3s ease;

            font-size: 17px;
        }

        .faq-answer {
            max-height: 0;

            overflow: hidden;

            transition:
                max-height 0.4s ease,
                padding 0.4s ease;
        }

        .faq-answer p {
            margin: 0;

            padding: 0 20px 20px;

            color: #99959f;

            font-size: 13px;

            line-height: 1.8;
        }

        .faq-item.active .faq-answer {
            max-height: 200px;
        }

        .faq-item.active .faq-plus {
            transform: rotate(45deg);

            background: rgba(255, 255, 255, 0.15);
        }


        /* =========================================================
           CTA
        ========================================================= */

        .final-cta {
            max-width: 1200px;

            margin: 20px auto 0;

            padding: 65px 50px;

            text-align: center;

            border-radius: 25px;

            background:
                linear-gradient(
                    135deg,
                    rgba(224, 224, 230, 0.12),
                    rgba(71, 69, 76, 0.10),
                    rgba(13, 4, 18, 0.40)
                );

            border:
                1px solid rgba(255, 255, 255, 0.10);

            box-shadow:
                0 25px 60px rgba(0, 0, 0, 0.20);
        }

        .final-cta h2 {
            margin: 0 0 15px;

            font-size: clamp(28px, 4vw, 42px);
        }

        .final-cta p {
            max-width: 650px;

            margin: 0 auto 28px;

            color: #aaa7ae;

            font-size: 14px;

            line-height: 1.8;
        }


        /* =========================================================
           FOOTER
        ========================================================= */

        .home-footer {
            margin-top: 60px;

            padding: 55px 7% 25px;

            background:
                rgba(7, 6, 8, 0.65);

            border-top:
                1px solid rgba(255, 255, 255, 0.07);
        }

        .footer-grid {
            max-width: 1250px;

            margin: auto;

            display: grid;

            grid-template-columns:
                1.5fr 1fr 1fr;

            gap: 50px;
        }

        .footer-brand p {
            max-width: 420px;

            color: #8f8b94;

            font-size: 13px;

            line-height: 1.8;
        }

        .footer-title {
            margin: 0 0 18px;

            color: white;

            font-size: 14px;
        }

        .footer-links {
            display: flex;

            flex-direction: column;

            gap: 10px;
        }

        .footer-links a {
            color: #8f8b94;

            font-size: 13px;

            transition: 0.3s ease;
        }

        .footer-links a:hover {
            color: white;

            transform: translateX(4px);
        }

        .footer-bottom {
            max-width: 1250px;

            margin: 45px auto 0;

            padding-top: 20px;

            border-top:
                1px solid rgba(255, 255, 255, 0.07);

            display: flex;

            justify-content: space-between;

            gap: 20px;

            color: #716d75;

            font-size: 11px;
        }


        /* =========================================================
           SCROLL REVEAL
        ========================================================= */

        .reveal {
            opacity: 0;

            transform: translateY(35px);

            transition:
                opacity 0.8s ease,
                transform 0.8s ease;
        }

        .reveal.show {
            opacity: 1;

            transform: translateY(0);
        }


        /* =========================================================
           BACK TO TOP
        ========================================================= */

        .back-to-top {
            position: fixed;

            z-index: 999;

            right: 25px;
            bottom: 25px;

            width: 45px;
            height: 45px;

            display: flex;
            align-items: center;
            justify-content: center;

            border: 1px solid rgba(255, 255, 255, 0.12);

            border-radius: 50%;

            background:
                rgba(30, 27, 32, 0.85);

            color: white;

            font-size: 18px;

            cursor: pointer;

            opacity: 0;

            visibility: hidden;

            transform: translateY(20px);

            transition: 0.3s ease;

            backdrop-filter: blur(10px);
        }

        .back-to-top.show {
            opacity: 1;

            visibility: visible;

            transform: translateY(0);
        }

        .back-to-top:hover {
            background:
                linear-gradient(
                    135deg,
                    #e0e0e6,
                    #47454c
                );

            color: #18161b;

            transform: translateY(-4px);
        }


        /* =========================================================
           RESPONSIVE
        ========================================================= */

        @media (max-width: 1100px) {

            .hero-content {
                width: 58%;
            }

            .hero-car-area {
                width: 42%;
                transform: translateY(-35%) scale(0.82);
            }

            .home-feature-grid {
                grid-template-columns:
                    repeat(2, 1fr);
            }

            .steps {
                grid-template-columns:
                    repeat(2, 1fr);

                row-gap: 45px;
            }

            .steps::before {
                display: none;
            }

            .why-grid {
                grid-template-columns:
                    repeat(2, 1fr);
            }

        }


        @media (max-width: 800px) {

            .home-navbar {
                padding: 15px 5%;
            }

            .home-logo {
                font-size: 16px;
            }

            .home-logo-icon {
                width: 32px;
                height: 32px;
            }

            .home-menu {
                gap: 2px;
            }

            .home-menu a {
                padding: 8px 8px;

                font-size: 11px;
            }

            .home-hero {
                min-height: auto;

                padding:
                    70px 7%
                    60px;

                flex-direction: column;

                align-items: flex-start;
            }

            .hero-content {
                width: 100%;
            }

            .hero-content h1 {
                font-size: 45px;
            }

            .hero-car-area {
                position: relative;

                width: 100%;

                right: auto;
                top: auto;

                transform: scale(0.80);

                margin:
                    20px auto
                    -20px;
            }

            .hero-stats {
                gap: 25px;
            }

            .info-strip {
                grid-template-columns: 1fr;
            }

            .rental-info {
                grid-template-columns: 1fr;
            }

            .footer-grid {
                grid-template-columns: 1fr 1fr;
            }

        }


        @media (max-width: 600px) {

            .home-menu a:nth-child(2) {
                display: none;
            }

            .home-logo {
                letter-spacing: 0.5px;
            }

            .home-hero {
                padding-top: 55px;
            }

            .hero-content h1 {
                font-size: 38px;

                letter-spacing: -1px;
            }

            .hero-content p {
                font-size: 14px;
            }

            .hero-buttons {
                width: 100%;

                flex-direction: column;

                align-items: stretch;
            }

            .hero-primary-btn,
            .hero-secondary-btn {
                width: 100%;
            }

            .hero-car-area {
                transform: scale(0.68);

                height: 270px;

                margin-left: -20px;
            }

            .home-section {
                padding:
                    70px 6%;
            }

            .home-feature-grid {
                grid-template-columns: 1fr;
            }

            .steps {
                grid-template-columns: 1fr;
            }

            .why-grid {
                grid-template-columns: 1fr;
            }

            .rental-panel {
                padding: 25px;
            }

            .final-cta {
                padding:
                    45px 25px;
            }

            .footer-grid {
                grid-template-columns: 1fr;
            }

            .footer-bottom {
                flex-direction: column;

                text-align: center;
            }

        }

    </style>
</head>


<body class="home-page">


<!-- =========================================================
     NAVBAR
========================================================= -->

<div class="home-navbar">

    <a href="index.php" class="home-logo">

        <div class="home-logo-icon">
            🚗
        </div>

        <span>RENTAL MOBIL</span>

    </a>


    <div class="home-menu">

        <a href="index.php" class="active">
            Home
        </a>

        <a href="armada.php">
            Armada
        </a>

        <a href="#fitur">
            Fitur
        </a>

        <a href="#cara-sewa">
            Cara Sewa
        </a>

        <?php if(isset($_SESSION['customer'])) { ?>

            <a href="customer/dashboard.php">
                Dashboard
            </a>

            <a href="logout.php">
                Logout
            </a>

        <?php } else { ?>

            <a href="login.php">
                Login
            </a>

            <a href="register.php">
                Register
            </a>

        <?php } ?>

    </div>

</div>



<!-- =========================================================
     HERO
========================================================= -->

<section class="home-hero" id="home">


    <div class="hero-glow-one"></div>
    <div class="hero-glow-two"></div>
    <div class="hero-glow-three"></div>


    <div class="hero-content">

        <div class="hero-label">

            <span class="hero-label-dot"></span>

            PLATFORM RENTAL MOBIL

        </div>


        <h1>

            Sewa Mobil
            <br>

            <span>
                Lebih Mudah.
            </span>

        </h1>


        <p>

            Temukan kendaraan yang sesuai dengan kebutuhan perjalananmu.
            Lihat armada, pilih kendaraan, tentukan tanggal sewa,
            dan lakukan pemesanan melalui satu platform.

        </p>


        <div class="hero-buttons">

            <a
                href="armada.php"
                class="hero-primary-btn"
            >

                Lihat Armada

                <span>→</span>

            </a>


            <a
                href="#cara-sewa"
                class="hero-secondary-btn"
            >

                Pelajari Cara Sewa

            </a>

        </div>


        <div class="hero-stats">

            <div class="hero-stat">

                <strong>01</strong>

                <span>
                    Pilih Armada
                </span>

            </div>


            <div class="hero-stat">

                <strong>02</strong>

                <span>
                    Tentukan Tanggal
                </span>

            </div>


            <div class="hero-stat">

                <strong>03</strong>

                <span>
                    Lakukan Pemesanan
                </span>

            </div>

        </div>

    </div>



    <!-- CSS CAR -->

    <div class="hero-car-area">

        <div class="road-line"></div>

        <div class="car-shadow"></div>


        <div class="css-car">

            <div class="car-body">

                <div class="car-window"></div>

                <div class="car-light"></div>

                <div class="car-back-light"></div>

                <div class="car-door"></div>

                <div class="car-handle"></div>

            </div>


            <div class="car-wheel wheel-left"></div>

            <div class="car-wheel wheel-right"></div>

        </div>

    </div>

</section>



<!-- =========================================================
     QUICK INFORMATION
========================================================= -->

<section class="home-section">

    <div class="info-strip reveal">


        <div class="info-box">

            <div class="info-icon">
                🚘
            </div>

            <div>

                <h3>
                    Pilihan Armada
                </h3>

                <p>
                    Lihat kendaraan yang tersedia
                    melalui halaman armada.
                </p>

            </div>

        </div>


        <div class="info-box">

            <div class="info-icon">
                📅
            </div>

            <div>

                <h3>
                    Tentukan Jadwal
                </h3>

                <p>
                    Pilih tanggal sesuai kebutuhan
                    perjalananmu.
                </p>

            </div>

        </div>


        <div class="info-box">

            <div class="info-icon">
                📋
            </div>

            <div>

                <h3>
                    Pantau Pesanan
                </h3>

                <p>
                    Status pemesanan dapat dipantau
                    melalui dashboard customer.
                </p>

            </div>

        </div>


    </div>

</section>



<!-- =========================================================
     FITUR UTAMA
========================================================= -->

<section
    class="home-section features-section"
    id="fitur"
>

    <div class="section-heading reveal">

        <span class="section-label">
            Fitur Utama
        </span>

        <h2>
            Semua yang Dibutuhkan
            dalam Satu Platform
        </h2>

        <p>
            Sistem rental mobil dirancang untuk membantu
            customer mulai dari mencari kendaraan sampai
            memantau proses pemesanan.
        </p>

    </div>



    <div class="home-feature-grid">


        <div class="home-feature-card reveal">

            <div class="feature-number">
                01
            </div>

            <div class="feature-icon">
                🔐
            </div>

            <h3>
                Login Customer
            </h3>

            <p>
                Customer dapat masuk ke sistem menggunakan
                akun yang telah didaftarkan.
            </p>

        </div>


        <div class="home-feature-card reveal">

            <div class="feature-number">
                02
            </div>

            <div class="feature-icon">
                🚗
            </div>

            <h3>
                Pilihan Armada
            </h3>

            <p>
                Lihat daftar kendaraan lengkap beserta
                informasi tipe, transmisi, harga dan
                ketersediaannya.
            </p>

        </div>


        <div class="home-feature-card reveal">

            <div class="feature-number">
                03
            </div>

            <div class="feature-icon">
                📅
            </div>

            <h3>
                Pemesanan Mobil
            </h3>

            <p>
                Customer dapat memilih armada dan menentukan
                tanggal sewa sesuai kebutuhan.
            </p>

        </div>


        <div class="home-feature-card reveal">

            <div class="feature-number">
                04
            </div>

            <div class="feature-icon">
                📊
            </div>

            <h3>
                Status Pemesanan
            </h3>

            <p>
                Pantau status pesanan seperti menunggu,
                diproses, selesai, atau dibatalkan.
            </p>

        </div>


        <div class="home-feature-card reveal">

            <div class="feature-number">
                05
            </div>

            <div class="feature-icon">
                💳
            </div>

            <h3>
                Pembayaran
            </h3>

            <p>
                Sistem menyediakan alur pembayaran sebagai
                bagian dari proses penyewaan kendaraan.
            </p>

        </div>


        <div class="home-feature-card reveal">

            <div class="feature-number">
                06
            </div>

            <div class="feature-icon">
                🔎
            </div>

            <h3>
                Pencarian Armada
            </h3>

            <p>
                Cari kendaraan dengan lebih mudah menggunakan
                fitur pencarian pada halaman armada.
            </p>

        </div>


        <div class="home-feature-card reveal">

            <div class="feature-number">
                07
            </div>

            <div class="feature-icon">
                📱
            </div>

            <h3>
                Tampilan Responsive
            </h3>

            <p>
                Tampilan website dapat menyesuaikan ukuran
                layar desktop, tablet, maupun smartphone.
            </p>

        </div>


        <div class="home-feature-card reveal">

            <div class="feature-number">
                08
            </div>

            <div class="feature-icon">
                ⚡
            </div>

            <h3>
                Proses Lebih Praktis
            </h3>

            <p>
                Informasi armada dan proses pemesanan
                tersedia dalam satu platform.
            </p>

        </div>


    </div>

</section>



<!-- =========================================================
     CARA SEWA
========================================================= -->

<section
    class="home-section steps-section"
    id="cara-sewa"
>

    <div class="section-heading reveal">

        <span class="section-label">
            Cara Sewa
        </span>

        <h2>
            Sewa Mobil dalam
            Beberapa Langkah
        </h2>

        <p>
            Alur sederhana untuk membantu customer
            melakukan pemesanan kendaraan.
        </p>

    </div>



    <div class="steps">


        <div class="step reveal">

            <div class="step-number">
                01
            </div>

            <h3>
                Pilih Armada
            </h3>

            <p>
                Buka halaman armada dan pilih kendaraan
                yang sesuai dengan kebutuhan.
            </p>

        </div>


        <div class="step reveal">

            <div class="step-number">
                02
            </div>

            <h3>
                Login
            </h3>

            <p>
                Masuk menggunakan akun customer
                sebelum melakukan pemesanan.
            </p>

        </div>


        <div class="step reveal">

            <div class="step-number">
                03
            </div>

            <h3>
                Tentukan Jadwal
            </h3>

            <p>
                Tentukan tanggal sewa dan lengkapi
                informasi pemesanan.
            </p>

        </div>


        <div class="step reveal">

            <div class="step-number">
                04
            </div>

            <h3>
                Pantau Pesanan
            </h3>

            <p>
                Cek status pemesanan melalui
                dashboard customer.
            </p>

        </div>


    </div>

</section>



<!-- =========================================================
     INFORMASI RENTAL
========================================================= -->

<section class="home-section">

    <div class="section-heading reveal">

        <span class="section-label">
            Informasi Rental
        </span>

        <h2>
            Pilih Kendaraan Sesuai
            Kebutuhan Perjalanan
        </h2>

        <p>
            Gunakan armada yang tersedia sesuai kebutuhan
            perjalanan dan durasi penggunaan kendaraan.
        </p>

    </div>



    <div class="rental-info">


        <div class="rental-panel reveal">

            <h3>
                🚘 Untuk Perjalanan Pribadi
            </h3>

            <p>
                Cocok untuk kebutuhan perjalanan bersama
                keluarga, teman, aktivitas pribadi,
                maupun perjalanan dalam kota.
            </p>


            <ul class="rental-list">

                <li>

                    <span class="check">
                        ✓
                    </span>

                    Pilih kendaraan sesuai kapasitas

                </li>

                <li>

                    <span class="check">
                        ✓
                    </span>

                    Tentukan tanggal penggunaan

                </li>

                <li>

                    <span class="check">
                        ✓
                    </span>

                    Periksa harga sewa kendaraan

                </li>

                <li>

                    <span class="check">
                        ✓
                    </span>

                    Pantau status pemesanan

                </li>

            </ul>

        </div>



        <div class="rental-panel reveal">

            <h3>
                🧳 Untuk Perjalanan Kelompok
            </h3>

            <p>
                Armada dapat dipilih berdasarkan kebutuhan
                kapasitas penumpang dan jenis perjalanan.
            </p>


            <ul class="rental-list">

                <li>

                    <span class="check">
                        ✓
                    </span>

                    Sesuaikan kendaraan dengan jumlah penumpang

                </li>

                <li>

                    <span class="check">
                        ✓
                    </span>

                    Periksa tipe dan transmisi kendaraan

                </li>

                <li>

                    <span class="check">
                        ✓
                    </span>

                    Cek ketersediaan sebelum memesan

                </li>

                <li>

                    <span class="check">
                        ✓
                    </span>

                    Gunakan dashboard untuk memantau pesanan

                </li>

            </ul>

        </div>


    </div>

</section>



<!-- =========================================================
     KENAPA MEMILIH PLATFORM
========================================================= -->

<section class="home-section features-section">

    <div class="section-heading reveal">

        <span class="section-label">
            Keunggulan
        </span>

        <h2>
            Dibuat untuk Pengalaman
            Rental yang Lebih Praktis
        </h2>

        <p>
            Sistem dibuat dengan fokus pada kemudahan
            customer dalam menemukan dan melakukan pemesanan
            kendaraan.
        </p>

    </div>



    <div class="why-grid">


        <div class="why-card reveal">

            <h3>
                Tampilan Sederhana
            </h3>

            <p>
                Informasi penting seperti armada, harga,
                status ketersediaan dan pemesanan dibuat
                mudah ditemukan.
            </p>

        </div>


        <div class="why-card reveal">

            <h3>
                Informasi Armada Jelas
            </h3>

            <p>
                Customer dapat melihat informasi kendaraan
                sebelum menentukan pilihan.
            </p>

        </div>


        <div class="why-card reveal">

            <h3>
                Status Pesanan
            </h3>

            <p>
                Customer dapat mengetahui perkembangan
                pesanan melalui sistem.
            </p>

        </div>


        <div class="why-card reveal">

            <h3>
                Pencarian Cepat
            </h3>

            <p>
                Fitur pencarian membantu customer menemukan
                kendaraan yang dibutuhkan dengan lebih cepat.
            </p>

        </div>


        <div class="why-card reveal">

            <h3>
                Responsive
            </h3>

            <p>
                Tampilan dirancang agar tetap nyaman digunakan
                pada berbagai ukuran layar.
            </p>

        </div>


        <div class="why-card reveal">

            <h3>
                Terintegrasi
            </h3>

            <p>
                Armada, akun customer, pemesanan dan status
                dapat digunakan dalam satu website.
            </p>

        </div>


    </div>

</section>



<!-- =========================================================
     FAQ
========================================================= -->

<section class="home-section">

    <div class="section-heading reveal">

        <span class="section-label">
            FAQ
        </span>

        <h2>
            Pertanyaan yang Sering Ditanyakan
        </h2>

        <p>
            Beberapa informasi umum mengenai penggunaan
            platform rental mobil.
        </p>

    </div>



    <div class="faq-container">


        <div class="faq-item reveal">

            <button
                type="button"
                class="faq-question"
            >

                <span>
                    Bagaimana cara melihat kendaraan yang tersedia?
                </span>

                <span class="faq-plus">
                    +
                </span>

            </button>


            <div class="faq-answer">

                <p>
                    Kamu dapat membuka halaman Armada untuk
                    melihat daftar kendaraan beserta informasi
                    kendaraan dan status ketersediaannya.
                </p>

            </div>

        </div>



        <div class="faq-item reveal">

            <button
                type="button"
                class="faq-question"
            >

                <span>
                    Apakah harus login untuk melakukan pemesanan?
                </span>

                <span class="faq-plus">
                    +
                </span>

            </button>


            <div class="faq-answer">

                <p>
                    Ya. Customer perlu login terlebih dahulu
                    sebelum melakukan pemesanan kendaraan.
                </p>

            </div>

        </div>



        <div class="faq-item reveal">

            <button
                type="button"
                class="faq-question"
            >

                <span>
                    Bagaimana mengetahui kendaraan sedang tersedia?
                </span>

                <span class="faq-plus">
                    +
                </span>

            </button>


            <div class="faq-answer">

                <p>
                    Status kendaraan dapat dilihat pada halaman
                    Armada. Kendaraan yang tersedia dapat dipilih
                    untuk melanjutkan proses pemesanan.
                </p>

            </div>

        </div>



        <div class="faq-item reveal">

            <button
                type="button"
                class="faq-question"
            >

                <span>
                    Apakah saya dapat melihat status pesanan?
                </span>

                <span class="faq-plus">
                    +
                </span>

            </button>


            <div class="faq-answer">

                <p>
                    Bisa. Setelah login, customer dapat membuka
                    Dashboard untuk melihat informasi dan status
                    pemesanan.
                </p>

            </div>

        </div>



        <div class="faq-item reveal">

            <button
                type="button"
                class="faq-question"
            >

                <span>
                    Bagaimana jika saya belum memiliki akun?
                </span>

                <span class="faq-plus">
                    +
                </span>

            </button>


            <div class="faq-answer">

                <p>
                    Kamu dapat memilih menu Register pada navbar
                    atau halaman Login untuk membuat akun customer.
                </p>

            </div>

        </div>


    </div>

</section>



<!-- =========================================================
     FINAL CTA
========================================================= -->

<section class="home-section">

    <div class="final-cta reveal">

        <h2>
            Siap Menemukan Armada?
        </h2>

        <p>
            Lihat daftar kendaraan yang tersedia dan pilih
            armada yang sesuai dengan kebutuhan perjalananmu.
        </p>


        <a
            href="armada.php"
            class="hero-primary-btn"
        >

            Lihat Armada

            <span>
                →
            </span>

        </a>

    </div>

</section>



<!-- =========================================================
     FOOTER
========================================================= -->

<footer class="home-footer">


    <div class="footer-grid">


        <div class="footer-brand">

            <a
                href="index.php"
                class="home-logo"
            >

                <div class="home-logo-icon">
                    🚗
                </div>

                <span>
                    RENTAL MOBIL
                </span>

            </a>


            <p>
                Platform rental mobil berbasis web yang
                membantu customer melihat armada, melakukan
                pemesanan, dan memantau status pesanan.
            </p>

        </div>



        <div>

            <h3 class="footer-title">
                Navigasi
            </h3>


            <div class="footer-links">

                <a href="index.php">
                    Home
                </a>

                <a href="armada.php">
                    Armada
                </a>

                <a href="#fitur">
                    Fitur
                </a>

                <a href="#cara-sewa">
                    Cara Sewa
                </a>

            </div>

        </div>



        <div>

            <h3 class="footer-title">
                Customer
            </h3>


            <div class="footer-links">

                <?php if(isset($_SESSION['customer'])) { ?>

                    <a href="customer/dashboard.php">
                        Dashboard
                    </a>

                    <a href="logout.php">
                        Logout
                    </a>

                <?php } else { ?>

                    <a href="login.php">
                        Login
                    </a>

                    <a href="register.php">
                        Register
                    </a>

                <?php } ?>

                <a href="armada.php">
                    Cari Armada
                </a>

            </div>

        </div>


    </div>



    <div class="footer-bottom">

        <span>
            © 2026 Rental Mobil Platform
        </span>

        <span>
            Web-based Car Rental System
        </span>

    </div>


</footer>



<!-- =========================================================
     BACK TO TOP
========================================================= -->

<button
    type="button"
    class="back-to-top"
    id="backToTop"
    aria-label="Kembali ke atas"
>
    ↑
</button>



<!-- =========================================================
     JAVASCRIPT
========================================================= -->

<script>


/* =========================================================
   FAQ
========================================================= */

const faqQuestions =
    document.querySelectorAll(".faq-question");


faqQuestions.forEach(function(question) {

    question.addEventListener("click", function() {

        const currentItem =
            this.parentElement;


        document
            .querySelectorAll(".faq-item")
            .forEach(function(item) {

                if (item !== currentItem) {

                    item.classList.remove("active");

                }

            });


        currentItem.classList.toggle("active");

    });

});



/* =========================================================
   SCROLL REVEAL
========================================================= */

const revealElements =
    document.querySelectorAll(".reveal");


const revealObserver =
    new IntersectionObserver(
        function(entries) {

            entries.forEach(function(entry) {

                if (entry.isIntersecting) {

                    entry.target.classList.add("show");

                    revealObserver.unobserve(
                        entry.target
                    );

                }

            });

        },
        {
            threshold: 0.12
        }
    );


revealElements.forEach(function(element) {

    revealObserver.observe(element);

});



/* =========================================================
   BACK TO TOP
========================================================= */

const backToTop =
    document.getElementById("backToTop");


window.addEventListener("scroll", function() {

    if (window.scrollY > 500) {

        backToTop.classList.add("show");

    } else {

        backToTop.classList.remove("show");

    }

});


backToTop.addEventListener("click", function() {

    window.scrollTo({

        top: 0,

        behavior: "smooth"

    });

});



/* =========================================================
   NAVBAR EFFECT SAAT SCROLL
========================================================= */

const navbar =
    document.querySelector(".home-navbar");


window.addEventListener("scroll", function() {

    if (window.scrollY > 30) {

        navbar.style.padding =
            "12px 6%";

    } else {

        navbar.style.padding =
            "18px 6%";

    }

});



/* =========================================================
   ACTIVE NAVIGATION
========================================================= */

const sections =
    document.querySelectorAll(
        "section[id]"
    );


const navLinks =
    document.querySelectorAll(
        ".home-menu a"
    );


window.addEventListener("scroll", function() {

    let currentSection = "";


    sections.forEach(function(section) {

        const sectionTop =
            section.offsetTop - 150;


        const sectionHeight =
            section.offsetHeight;


        if (
            window.scrollY >= sectionTop &&
            window.scrollY <
            sectionTop + sectionHeight
        ) {

            currentSection =
                section.getAttribute("id");

        }

    });


    navLinks.forEach(function(link) {

        link.classList.remove("active");


        const href =
            link.getAttribute("href");


        if (
            href === "#" + currentSection
        ) {

            link.classList.add("active");

        }

    });


    if (window.scrollY < 300) {

        navLinks.forEach(function(link) {

            link.classList.remove("active");

        });


        const homeLink =
            document.querySelector(
                '.home-menu a[href="index.php"]'
            );


        if (homeLink) {

            homeLink.classList.add("active");

        }

    }

});


</script>


</body>
</html>