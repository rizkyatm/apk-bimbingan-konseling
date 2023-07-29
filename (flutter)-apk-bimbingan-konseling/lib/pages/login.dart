import 'dart:convert';

import 'package:flutter/material.dart';
import 'package:flutter/gestures.dart';
import 'dart:ui';
import 'package:google_fonts/google_fonts.dart';
import 'package:myapp/pages/list-view-pertemuan.dart';
import 'package:myapp/pages/method/api.dart';
import 'package:page_transition/page_transition.dart';
import 'package:shared_preferences/shared_preferences.dart';

class LoginPage extends StatefulWidget {
  @override
  State<LoginPage> createState() => _LoginPageState();
}

class _LoginPageState extends State<LoginPage> {
  TextEditingController nisn = TextEditingController();
  TextEditingController password = TextEditingController();
  void loginUser() async {
    final data = {
      'nisn_nip': nisn.text.toString(),
      'password': password.text.toString(),
    };

    final result = await API().postRequest(route: '/login', data: data);
    final response = jsonDecode(result.body);
    if (response['status'] == 200) {
      
      SharedPreferences preferences = await SharedPreferences.getInstance();
      await preferences.setString('namasiswa', response['user']['name']);
      await preferences.setInt('user_id', response['user']['siswa']['id']);
      await preferences.setString('token', response['token']);
      ScaffoldMessenger.of(context).showSnackBar(SnackBar(
        content: Text(response['message']),
      ));
      Navigator.of(context).pushReplacement(MaterialPageRoute(
        builder: (context) => ListPage(),
      ));
    }
  }

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
              // loginkv2 (20:701)
              padding: EdgeInsets.fromLTRB(
                  31 * fem, 138 * fem, 30.25 * fem, 138 * fem),
              width: double.infinity,
              height: 800 * fem,
              decoration: BoxDecoration(
                color: Color(0xffffffff),
              ),
              child: Container(
                // group190o18 (20:702)
                width: double.infinity,
                height: double.infinity,
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.center,
                  children: [
                    Container(
                      // imageloginJCn (20:703)
                      width: 298.75 * fem,
                      height: 160.84 * fem,
                      child: Image.asset(
                        'assets/page-1/images/image-login.png',
                        width: 298.75 * fem,
                        height: 160.84 * fem,
                      ),
                    ),
                    Container(
                      padding: EdgeInsets.fromLTRB(
                          7 * fem, 30.16 * fem, 6.75 * fem, 0 * fem),
                      width: double.infinity,
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.center,
                        children: [
                          Container(
                            margin: EdgeInsets.fromLTRB(
                                0 * fem, 0 * fem, 10 * fem, 17 * fem),
                            width: 275 * fem,
                            height: 79 * fem,
                            child: Stack(
                              children: [
                                Positioned(
                                  left: 0 * fem,
                                  top: 0 * fem,
                                  child: Align(
                                    child: SizedBox(
                                      width: 175 * fem,
                                      height: 45 * fem,
                                      child: Text(
                                        'Welcome!',
                                        style: GoogleFonts.poppins(
                                          fontSize: 30 * ffem,
                                          fontWeight: FontWeight.w700,
                                          height: 1.5 * ffem / fem,
                                          letterSpacing: 2.1 * fem,
                                          color: Color(0xff008bd9),
                                        ),
                                      ),
                                    ),
                                  ),
                                ),
                                Positioned(
                                  left: 0 * fem,
                                  top: 43 * fem,
                                  child: Align(
                                    child: SizedBox(
                                      width: 275 * fem,
                                      height: 36 * fem,
                                      child: Text(
                                        'Access your account by logging in with your credentials.',
                                        style: GoogleFonts.poppins(
                                          fontSize: 12 * ffem,
                                          fontWeight: FontWeight.w400,
                                          height: 1.5 * ffem / fem,
                                          letterSpacing: 0.24 * fem,
                                          color: Color(0xff218ecb),
                                        ),
                                      ),
                                    ),
                                  ),
                                ),
                              ],
                            ),
                          ),
                          Container(
                            margin: EdgeInsets.fromLTRB(
                                0 * fem, 0 * fem, 0 * fem, 29 * fem),
                            width: double.infinity,
                            decoration: BoxDecoration(
                              borderRadius: BorderRadius.circular(5 * fem),
                            ),
                            child: Column(
                              crossAxisAlignment: CrossAxisAlignment.center,
                              children: [
                                Container(
                                  margin: EdgeInsets.fromLTRB(
                                      0 * fem, 0 * fem, 0 * fem, 18 * fem),
                                  width: double.infinity,
                                  decoration: BoxDecoration(
                                    borderRadius:
                                        BorderRadius.circular(5 * fem),
                                  ),
                                  child: Column(
                                    crossAxisAlignment:
                                        CrossAxisAlignment.start,
                                    children: [
                                      Container(
                                        margin: EdgeInsets.fromLTRB(
                                            0 * fem, 0 * fem, 0 * fem, 4 * fem),
                                        child: Text(
                                          'NISN',
                                          style: GoogleFonts.poppins(
                                            fontSize: 11 * ffem,
                                            fontWeight: FontWeight.w600,
                                            height: 1.5 * ffem / fem,
                                            color: Color(0xff008bd9),
                                          ),
                                        ),
                                      ),
                                      Container(
                                        width: double.infinity,
                                        decoration: BoxDecoration(
                                          borderRadius:
                                              BorderRadius.circular(5 * fem),
                                          border: Border.all(
                                              color: Color(0xffa5c6e4)),
                                        ),
                                        child: TextField(
                                          controller: nisn,
                                          decoration: InputDecoration(
                                            border: InputBorder.none,
                                            focusedBorder: InputBorder.none,
                                            enabledBorder: InputBorder.none,
                                            errorBorder: InputBorder.none,
                                            disabledBorder: InputBorder.none,
                                            contentPadding: EdgeInsets.fromLTRB(
                                                16 * fem,
                                                17 * fem,
                                                16 * fem,
                                                17 * fem),
                                            hintText: 'Masukan NISN',
                                            hintStyle: TextStyle(
                                                color: Color(0xffcad5ea)),
                                          ),
                                          style: GoogleFonts.poppins(
                                            fontSize: 10 * ffem,
                                            fontWeight: FontWeight.w400,
                                            height: 1.5 * ffem / fem,
                                            color: Color(0xff000000),
                                          ),
                                        ),
                                      ),
                                    ],
                                  ),
                                ),
                                Container(
                                  // group188rqt (20:844)
                                  width: double.infinity,
                                  decoration: BoxDecoration(
                                    borderRadius:
                                        BorderRadius.circular(5 * fem),
                                  ),
                                  child: Column(
                                    crossAxisAlignment:
                                        CrossAxisAlignment.start,
                                    children: [
                                      Container(
                                        // passwordaWz (20:848)
                                        margin: EdgeInsets.fromLTRB(
                                            0 * fem, 0 * fem, 0 * fem, 5 * fem),
                                        child: Text(
                                          'Password',
                                          style: GoogleFonts.poppins(
                                            fontSize: 11 * ffem,
                                            fontWeight: FontWeight.w600,
                                            height: 1.5 * ffem / fem,
                                            color: Color(0xff008bd9),
                                          ),
                                        ),
                                      ),
                                      Container(
                                        // group187UcN (20:845)
                                        width: double.infinity,
                                        decoration: BoxDecoration(
                                          borderRadius:
                                              BorderRadius.circular(5 * fem),
                                          border: Border.all(
                                              color: Color(0xffa5c6e4)),
                                        ),
                                        child: TextField(
                                          controller: password,
                                          obscureText: true,
                                          decoration: InputDecoration(
                                            border: InputBorder.none,
                                            focusedBorder: InputBorder.none,
                                            enabledBorder: InputBorder.none,
                                            errorBorder: InputBorder.none,
                                            disabledBorder: InputBorder.none,
                                            contentPadding: EdgeInsets.fromLTRB(
                                                17 * fem,
                                                17 * fem,
                                                17 * fem,
                                                17 * fem),
                                            hintText: 'Masukan Password',
                                            hintStyle: TextStyle(
                                                color: Color(0xffcad5ea)),
                                          ),
                                          style: GoogleFonts.poppins(
                                            fontSize: 10 * ffem,
                                            fontWeight: FontWeight.w400,
                                            height: 1.5 * ffem / fem,
                                            color: Color(0xff000000),
                                          ),
                                        ),
                                      
                                      ),
                                    ],
                                  ),
                                ),
                              ],
                            ),
                          ),
                          TextButton(
                            onPressed: () {},
                            style: TextButton.styleFrom(
                              padding: EdgeInsets.zero,
                            ),
                            child: InkWell(
                              onTap: () {
                                loginUser();
                                // Navigator.push(
                                //     context,
                                //     MaterialPageRoute(
                                //         builder: (context) => ListPage()));
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
                        ],
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
