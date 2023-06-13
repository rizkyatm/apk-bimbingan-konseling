import 'package:flutter/material.dart';
import 'package:flutter/gestures.dart';
import 'dart:ui';
import 'package:google_fonts/google_fonts.dart';
import 'package:lottie/lottie.dart';
import 'package:page_transition/page_transition.dart';
import 'package:myapp/pages/splash-screen2.dart';

class SplashScreen1 extends StatefulWidget {
  @override
  State<SplashScreen1> createState() => _SplashScreen1State();
}

class _SplashScreen1State extends State<SplashScreen1> {
  @override
  void initState() {
    super.initState();
    navigateToNextScreen();
  }

  void navigateToNextScreen() async {
    await Future.delayed(Duration(seconds: 3));
    Navigator.pushReplacement(
      context,
      PageTransition(
        type: PageTransitionType.fade,
        child: SplashScreen2(),
      ),
    );
  }

  Widget build(BuildContext context) {
    double baseWidth = 360;
    double fem = MediaQuery.of(context).size.width / baseWidth;
    double ffem = fem * 0.97;
    return Scaffold(
      body: ListView(
        children: [
          Container(
            width: double.infinity,
            child: Container(
              padding:
                  EdgeInsets.fromLTRB(76 * fem, 635 * fem, 78 * fem, 0 * fem),
              width: double.infinity,
              height: 800 * fem,
              decoration: BoxDecoration(
                gradient: LinearGradient(
                  begin: Alignment(0, -1),
                  end: Alignment(0, 1),
                  colors: <Color>[
                    Color(0xffd7ebff),
                    Color(0xffffffff),
                    Color(0xffffffff)
                  ],
                  stops: <double>[0, 0.515, 1],
                ),
              ),
              child: Column(
                children: [
                  Container(
                    width: 120,
                    child: Lottie.network(
                      'https://assets7.lottiefiles.com/packages/lf20_qxnvi40s.json',
                    ),
                  ),
                  Container(
                    transform: Matrix4.translationValues(0.0, -35, 0.0),
                    child: Text(
                      'TB Counseling',
                      style: GoogleFonts.poppins(
                        fontSize: 25 * ffem,
                        fontWeight: FontWeight.w700,
                        height: 1.5 * ffem / fem,
                        letterSpacing: 1.75 * fem,
                        color: Color(0xff008bd9),
                      ),
                    ),
                  ),
                ],
              ),
            ),
          ),
        ],
      ),
    );
  }
}
