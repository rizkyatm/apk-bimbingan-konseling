import 'package:flutter/material.dart';
import 'package:flutter/gestures.dart';
import 'dart:ui';
import 'package:google_fonts/google_fonts.dart';
import 'package:myapp/pages/login.dart';
import 'package:page_transition/page_transition.dart';

class SplashScreen2 extends StatefulWidget {
  @override
  State<SplashScreen2> createState() => _SplashScreen2State();
}

class _SplashScreen2State extends State<SplashScreen2> {
  @override
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
                  EdgeInsets.fromLTRB(28 * fem, 189 * fem, 27 * fem, 189 * fem),
              width: double.infinity,
              height: 800 * fem,
              decoration: BoxDecoration(
                gradient: LinearGradient(
                  begin: Alignment(0, -1),
                  end: Alignment(0, 1),
                  colors: <Color>[
                    Color(0xfff2f2ff),
                    Color(0xfffcfcff),
                    Color(0xffffffff)
                  ],
                  stops: <double>[0, 0.436, 1],
                ),
              ),
              child: Container(
                padding:
                    EdgeInsets.fromLTRB(0 * fem, 11.24 * fem, 0 * fem, 0 * fem),
                width: double.infinity,
                height: double.infinity,
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.center,
                  children: [
                    Container(
                      margin: EdgeInsets.fromLTRB(
                          0 * fem, 0 * fem, 8.18 * fem, 23.01 * fem),
                      width: 228.21 * fem,
                      height: 227.75 * fem,
                      child: Image.asset(
                        'assets/page-1/images/image-splashscreen.png',
                        width: 228.21 * fem,
                        height: 227.75 * fem,
                      ),
                    ),
                    Container(
                      margin: EdgeInsets.fromLTRB(
                          0 * fem, 0 * fem, 0 * fem, 29 * fem),
                      width: double.infinity,
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.center,
                        children: [
                          Container(
                            margin: EdgeInsets.fromLTRB(
                                0 * fem, 0 * fem, 1 * fem, 5 * fem),
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
                          Container(
                            constraints: BoxConstraints(
                              maxWidth: 305 * fem,
                            ),
                            child: Text(
                              'Selamat datang di TBCounseling! \nSilakan login untuk mengakses layanan kami',
                              textAlign: TextAlign.center,
                              style: GoogleFonts.poppins(
                                fontSize: 13 * ffem,
                                fontWeight: FontWeight.w400,
                                height: 1.5 * ffem / fem,
                                letterSpacing: 0.26 * fem,
                                color: Color(0xff218ecb),
                              ),
                            ),
                          ),
                        ],
                      ),
                    ),
                    Container(
                      margin: EdgeInsets.fromLTRB(
                          56 * fem, 0 * fem, 54 * fem, 0 * fem),
                      child: TextButton(
                        onPressed: () {},
                        style: TextButton.styleFrom(
                          padding: EdgeInsets.zero,
                        ),
                        child: InkWell(
                          onTap: () {
                            Navigator.pushReplacement(
                              context,
                              PageTransition(
                                type: PageTransitionType
                                    .fade,
                                child: LoginPage(),
                              ),
                            );
                          },
                          child: Container(
                            width: double.infinity,
                            height: 49 * fem,
                            decoration: BoxDecoration(
                              color: Color(0xff4bbbfa),
                              borderRadius: BorderRadius.circular(5 * fem),
                            ),
                            child: Center(
                              child: Text(
                                'Log in',
                                textAlign: TextAlign.center,
                                style: GoogleFonts.poppins(
                                  fontSize: 15 * ffem,
                                  fontWeight: FontWeight.w500,
                                  height: 1.5 * ffem / fem,
                                  color: Color(0xffffffff),
                                ),
                              ),
                            ),
                          ),
                        ),
                      ),
                    ),
                  ],
                ),
              ),
            ),
          ),
        ],
      ),
    );
  }
}
