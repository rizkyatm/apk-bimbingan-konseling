import 'package:flutter/material.dart';
import 'package:flutter/src/widgets/framework.dart';
import 'package:flutter/src/widgets/placeholder.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:myapp/pages/list-view-pertemuan.dart';

class ProfilePage extends StatefulWidget {
  final Map profile;
  ProfilePage({super.key, required this.profile});

  @override
  State<ProfilePage> createState() => _ProfilePageState();
}

class _ProfilePageState extends State<ProfilePage> {
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
                  EdgeInsets.fromLTRB(0 * fem, 26 * fem, 0 * fem, 99 * fem),
              width: double.infinity,
              decoration: BoxDecoration(
                color: Color(0xffffffff),
              ),
              child: Column(
                  crossAxisAlignment: CrossAxisAlignment.center,
                  children: [
                    Container(
                      margin: EdgeInsets.fromLTRB(
                          15 * fem, 0 * fem, 14.74 * fem, 17.74 * fem),
                      width: double.infinity,
                      child: Row(
                        crossAxisAlignment: CrossAxisAlignment.center,
                        children: [
                          Container(
                            margin: EdgeInsets.fromLTRB(
                                230 * fem, 0 * fem, 0 * fem, 0.26 * fem),
                            child: Text(
                              'TB Counseling',
                              style: GoogleFonts.poppins(
                                fontSize: 12 * ffem,
                                fontWeight: FontWeight.w700,
                                height: 1.5 * ffem / fem,
                                letterSpacing: 0.84 * fem,
                                color: Color(0xff4bbbfa),
                              ),
                            ),
                          ),
                        ],
                      ),
                    ),
                    Container(
                      width: double.infinity,
                      height: 700 * fem,
                      child: Stack(
                        children: [
                          Positioned(
                            left: 0 * fem,
                            top: 0 * fem,
                            child: Align(
                              child: SizedBox(
                                width: 360 * fem,
                                height: 320 * fem,
                                child: Container(
                                  decoration: BoxDecoration(
                                    color: Color(0xfff3f9ff),
                                  ),
                                ),
                              ),
                            ),
                          ),
                          Positioned(
                            left: 118 * fem,
                            top: 60 * fem,
                            child: Align(
                              child: SizedBox(
                                width: 125 * fem,
                                height: 125 * fem,
                                child: Container(
                                  decoration: BoxDecoration(
                                    borderRadius: BorderRadius.circular(500),
                                    boxShadow: [
                                      BoxShadow(
                                        color: Color(0xfff2f2ff),
                                        offset: Offset(0 * fem, 1 * fem),
                                        blurRadius: 15 * fem,
                                      ),
                                    ],
                                    image: DecorationImage(
                                      image: AssetImage(
                                          'assets/page-1/images/profile.png'),
                                      fit: BoxFit.cover,
                                    ),
                                  ),
                                ),
                              ),
                            ),
                          ),
                          Positioned(
                            left: 0 * fem,
                            top: 280 * fem,
                            child: Align(
                              child: SizedBox(
                                width: 360 * fem,
                                height: 470 * fem,
                                child: Container(
                                  decoration: BoxDecoration(
                                    borderRadius: BorderRadius.only(
                                        topLeft: Radius.circular(20 * fem),
                                        topRight: Radius.circular(20 * fem)),
                                    color: Color(0xffffffff),
                                    boxShadow: [
                                      BoxShadow(
                                        color: Color(0xfff2f2ff),
                                        offset: Offset(0 * fem, 1 * fem),
                                        blurRadius: 15 * fem,
                                      ),
                                    ],
                                  ),
                                ),
                              ),
                            ),
                          ),
                          Positioned(
                            left: 0 * fem,
                            top: 210 * fem,
                            child: Align(
                              child: SizedBox(
                                width: 360 * fem,
                                height: 470 * fem,
                                child: Text(
                                  // 'Septhea Zisca Aurora',
                                  widget.profile['namasiswa'],
                                  textAlign: TextAlign.center,
                                  style: GoogleFonts.poppins(
                                      color: Color(0xff4BBBFA),
                                      fontWeight: FontWeight.w700,
                                      fontSize: 18 * ffem,
                                      letterSpacing: 2 * fem),
                                ),
                              ),
                            ),
                          ),
                          Positioned(
                            left: 33 * fem,
                            top: 320 * fem,
                            child: Container(
                              width: 295 * fem,
                              height: 63 * fem,
                              decoration: BoxDecoration(
                                borderRadius: BorderRadius.circular(5 * fem),
                              ),
                              child: Column(
                                crossAxisAlignment: CrossAxisAlignment.start,
                                children: [
                                  Container(
                                    margin: EdgeInsets.fromLTRB(
                                        0 * fem, 0 * fem, 0 * fem, 6 * fem),
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
                                    padding: EdgeInsets.fromLTRB(
                                        0 * fem, 10 * fem, 15 * fem, 0 * fem),
                                    width: double.infinity,
                                    height: 40 * fem,
                                    decoration: BoxDecoration(
                                        border: Border(
                                            bottom: BorderSide(
                                      color: Color(0xffa5c6e4),
                                      width: 1,
                                    ))),
                                    child: Text(
                                      widget.profile['nisn'],
                                      style: GoogleFonts.poppins(
                                        fontSize: 12 * ffem,
                                        height: 1.5 * ffem / fem,
                                        color: Color(0xff218ECB),
                                      ),
                                    ),
                                  )
                                ],
                              ),
                            ),
                          ),
                          Positioned(
                            left: 33 * fem,
                            top: 403 * fem,
                            child: Container(
                              width: 295 * fem,
                              height: 63 * fem,
                              decoration: BoxDecoration(
                                borderRadius: BorderRadius.circular(5 * fem),
                              ),
                              child: Column(
                                crossAxisAlignment: CrossAxisAlignment.start,
                                children: [
                                  Container(
                                    margin: EdgeInsets.fromLTRB(
                                        0 * fem, 0 * fem, 0 * fem, 6 * fem),
                                    child: Text(
                                      'Kelas',
                                      style: GoogleFonts.poppins(
                                        fontSize: 11 * ffem,
                                        fontWeight: FontWeight.w600,
                                        height: 1.5 * ffem / fem,
                                        color: Color(0xff008bd9),
                                      ),
                                    ),
                                  ),
                                  Container(
                                    padding: EdgeInsets.fromLTRB(
                                        0 * fem, 10 * fem, 15 * fem, 0 * fem),
                                    width: double.infinity,
                                    height: 40 * fem,
                                    decoration: BoxDecoration(
                                        border: Border(
                                            bottom: BorderSide(
                                      color: Color(0xffa5c6e4),
                                      width: 1,
                                    ))),
                                    child: Text(
                                      widget.profile['kelas'],
                                      style: GoogleFonts.poppins(
                                        fontSize: 12 * ffem,
                                        height: 1.5 * ffem / fem,
                                        color: Color(0xff218ECB),
                                      ),
                                    ),
                                  )
                                ],
                              ),
                            ),
                          ),
                          Positioned(
                            left: 33 * fem,
                            top: 486 * fem,
                            child: Container(
                              width: 295 * fem,
                              height: 63 * fem,
                              decoration: BoxDecoration(
                                borderRadius: BorderRadius.circular(5 * fem),
                              ),
                              child: Column(
                                crossAxisAlignment: CrossAxisAlignment.start,
                                children: [
                                  Container(
                                    margin: EdgeInsets.fromLTRB(
                                        0 * fem, 0 * fem, 0 * fem, 6 * fem),
                                    child: Text(
                                      'Jenis Kelamin',
                                      style: GoogleFonts.poppins(
                                        fontSize: 11 * ffem,
                                        fontWeight: FontWeight.w600,
                                        height: 1.5 * ffem / fem,
                                        color: Color(0xff008bd9),
                                      ),
                                    ),
                                  ),
                                  Container(
                                    padding: EdgeInsets.fromLTRB(
                                        0 * fem, 10 * fem, 15 * fem, 0 * fem),
                                    width: double.infinity,
                                    height: 40 * fem,
                                    decoration: BoxDecoration(
                                        border: Border(
                                            bottom: BorderSide(
                                      color: Color(0xffa5c6e4),
                                      width: 1,
                                    ))),
                                    child: Text(
                                      widget.profile['jeniskelamin'],
                                      style: GoogleFonts.poppins(
                                        fontSize: 12 * ffem,
                                        height: 1.5 * ffem / fem,
                                        color: Color(0xff218ECB),
                                      ),
                                    ),
                                  )
                                ],
                              ),
                            ),
                          ),
                          Positioned(
                            left: 33 * fem,
                            top: 569 * fem,
                            child: Container(
                              width: 295 * fem,
                              height: 63 * fem,
                              decoration: BoxDecoration(
                                borderRadius: BorderRadius.circular(5 * fem),
                              ),
                              child: Column(
                                crossAxisAlignment: CrossAxisAlignment.start,
                                children: [
                                  Container(
                                    margin: EdgeInsets.fromLTRB(
                                        0 * fem, 0 * fem, 0 * fem, 6 * fem),
                                    child: Text(
                                      'Tempat, Tanggal Lahir',
                                      style: GoogleFonts.poppins(
                                        fontSize: 11 * ffem,
                                        fontWeight: FontWeight.w600,
                                        height: 1.5 * ffem / fem,
                                        color: Color(0xff008bd9),
                                      ),
                                    ),
                                  ),
                                  Container(
                                    padding: EdgeInsets.fromLTRB(
                                        0 * fem, 10 * fem, 15 * fem, 0 * fem),
                                    width: double.infinity,
                                    height: 40 * fem,
                                    decoration: BoxDecoration(
                                        border: Border(
                                            bottom: BorderSide(
                                      color: Color(0xffa5c6e4),
                                      width: 1,
                                    ))),
                                    child: Text(
                                      '${widget.profile['tempatlahir']}, ${widget.profile['tanggallahir']}',
                                      style: GoogleFonts.poppins(
                                        fontSize: 12 * ffem,
                                        height: 1.5 * ffem / fem,
                                        color: Color(0xff218ECB),
                                      ),
                                    ),
                                  )
                                ],
                              ),
                            ),
                          ),
                          Positioned(
                            // group190a2M (2:939)
                            left: 33 * fem,
                            top: 660 * fem,
                            child: TextButton(
                              onPressed: () {},
                              style: TextButton.styleFrom(
                                padding: EdgeInsets.zero,
                              ),
                              child: InkWell(
                                onTap: () {
                                  Navigator.push(
                                      context,
                                      MaterialPageRoute(
                                          builder: (context) => ListPage()));
                                },
                                child: Container(
                                  width: 295 * fem,
                                  height: 40 * fem,
                                  decoration: BoxDecoration(
                                    color: Color(0xff4bbbfa),
                                    borderRadius:
                                        BorderRadius.circular(5 * fem),
                                  ),
                                  child: Center(
                                    child: Text(
                                      'Kembali',
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
                    )
                  ]),
            ),
          )
        ],
      ),
    );
  }
}
