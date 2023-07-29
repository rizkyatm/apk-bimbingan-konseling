import 'package:flutter/material.dart';
import 'package:flutter/src/widgets/framework.dart';
import 'package:flutter/src/widgets/placeholder.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:myapp/pages/list-view-pertemuan.dart';
import 'package:intl/intl.dart';

class JadwalPage extends StatefulWidget {
  const JadwalPage({super.key});

  @override
  State<JadwalPage> createState() => _JadwalPageState();
}

class _JadwalPageState extends State<JadwalPage> {
  // layanan bimbingan bk
  String? selectedValue;
  List<String> items = ["Item 1", "Item 2", "Item 3", "Item 4"];

  // tanggal bimbingan
  TextEditingController datetimeinput = TextEditingController();
  void initState() {
    datetimeinput.text = "";
    super.initState();
  }

  // waktu bimbingan
  TextEditingController _timeController = TextEditingController();
  Future<void> _selectTime(BuildContext context) async {
    TimeOfDay? pickedTime = await showTimePicker(
      context: context,
      initialTime: TimeOfDay.now(),
    );
    if (pickedTime != null) {
      String formattedTime = pickedTime.format(context);
      _timeController.text = formattedTime;
    }
  }

  // tempat
  TextEditingController tempat = TextEditingController();

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
                                0 * fem, 0 * fem, 203 * fem, 0.26 * fem),
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
                          Container(
                            // maskgroupqiR (1:551)
                            width: 28.26 * fem,
                            height: 28.26 * fem,
                            child: Image.asset(
                              'assets/page-1/images/mask-group.png',
                              width: 28.26 * fem,
                              height: 28.26 * fem,
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
                                height: 253 * fem,
                                child: Container(
                                  decoration: BoxDecoration(
                                    color: Color(0xfff3f9ff),
                                  ),
                                ),
                              ),
                            ),
                          ),
                          Positioned(
                            left: 210.1829833984 * fem,
                            top: 25.8183898926 * fem,
                            child: Align(
                              child: SizedBox(
                                width: 126.46 * fem,
                                height: 122.37 * fem,
                                child: Image.asset(
                                  'assets/page-1/images/image-bg2.png',
                                  width: 126.46 * fem,
                                  height: 122.37 * fem,
                                ),
                              ),
                            ),
                          ),
                          Positioned(
                            left: 36 * fem,
                            top: 42 * fem,
                            child: Container(
                              width: 166 * fem,
                              height: 87 * fem,
                              child: Column(
                                crossAxisAlignment: CrossAxisAlignment.start,
                                children: [
                                  Container(
                                    constraints: BoxConstraints(
                                      maxWidth: 127 * fem,
                                    ),
                                    child: Text(
                                      'Jadwal\nBimbingan',
                                      style: GoogleFonts.poppins(
                                        fontSize: 20 * ffem,
                                        fontWeight: FontWeight.w700,
                                        height: 1.5 * ffem / fem,
                                        letterSpacing: 1.4 * fem,
                                        color: Color(0xff4bbbfa),
                                      ),
                                    ),
                                  ),
                                  Container(
                                    constraints: BoxConstraints(
                                      maxWidth: 166 * fem,
                                    ),
                                    child: Text(
                                      'Buat jadwal bimbingan mu dengen Pembimbing Konseling.',
                                      style: GoogleFonts.poppins(
                                        fontSize: 9 * ffem,
                                        fontWeight: FontWeight.w400,
                                        height: 1.5 * ffem / fem,
                                        letterSpacing: 0.18 * fem,
                                        color: Color(0xff73bde6),
                                      ),
                                    ),
                                  ),
                                ],
                              ),
                            ),
                          ),
                          Positioned(
                            left: 22.3928222656 * fem,
                            top: 52.3874206543 * fem,
                            child: InkWell(
                              onTap: () {
                                Navigator.push(
                                    context,
                                    MaterialPageRoute(
                                        builder: (context) => ListPage()));
                              },
                              child: Align(
                                child: SizedBox(
                                  width: 8.44 * fem,
                                  height: 8.22 * fem,
                                  child: Image.asset(
                                    'assets/page-1/images/back.png',
                                    width: 8.44 * fem,
                                    height: 8.22 * fem,
                                  ),
                                ),
                              ),
                            ),
                          ),
                          Positioned(
                            left: 30 * fem,
                            top: 179 * fem,
                            child: Align(
                              child: SizedBox(
                                width: 300 * fem,
                                height: 440 * fem,
                                child: Container(
                                  decoration: BoxDecoration(
                                    borderRadius:
                                        BorderRadius.circular(15 * fem),
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
                            left: 58 * fem,
                            top: 204 * fem,
                            child: Align(
                              child: SizedBox(
                                width: 194 * fem,
                                height: 23 * fem,
                                child: Text(
                                  'Buat jadwal bimbingan ',
                                  style: GoogleFonts.poppins(
                                    fontSize: 15 * ffem,
                                    fontWeight: FontWeight.w700,
                                    height: 1.5 * ffem / fem,
                                    letterSpacing: 0.45 * fem,
                                    color: Color(0xff218ecb),
                                  ),
                                ),
                              ),
                            ),
                          ),
                          Positioned(
                            left: 58 * fem,
                            top: 241 * fem,
                            child: Container(
                              width: 244 * fem,
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
                                      'Layanan Bimbingan',
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
                                        15 * fem, 0 * fem, 15 * fem, 0 * fem),
                                    width: double.infinity,
                                    height: 40 * fem,
                                    decoration: BoxDecoration(
                                      borderRadius:
                                          BorderRadius.circular(5 * fem),
                                      border:
                                          Border.all(color: Color(0xffa5c6e4)),
                                    ),
                                    child: DropdownButtonHideUnderline(
                                      child: Row(
                                        mainAxisAlignment:
                                            MainAxisAlignment.spaceBetween,
                                        children: [
                                          Expanded(
                                            child: DropdownButton<String>(
                                              hint: Text(
                                                "Select item",
                                                style: GoogleFonts.poppins(
                                                    fontSize: 10 * ffem,
                                                    color: Color(0xffa5c6e4)),
                                              ),
                                              dropdownColor: Colors.white,
                                              isExpanded: true,
                                              value: selectedValue,
                                              onChanged: (newValue) {
                                                setState(() {
                                                  selectedValue = newValue;
                                                });
                                              },
                                              items: items.map((valueItem) {
                                                return DropdownMenuItem<String>(
                                                  value: valueItem,
                                                  child: Text(
                                                    valueItem,
                                                    style: TextStyle(
                                                        fontSize: 11 * ffem,
                                                        color: Colors.black),
                                                  ),
                                                );
                                              }).toList(),
                                            ),
                                          ),
                                        ],
                                      ),
                                    ),
                                  )
                                ],
                              ),
                            ),
                          ),
                          Positioned(
                            left: 58 * fem,
                            top: 315 * fem,
                            child: Container(
                              width: 244 * fem,
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
                                      'Tanggal',
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
                                        15 * fem, 0 * fem, 15 * fem, 0 * fem),
                                    width: double.infinity,
                                    height: 40 * fem,
                                    decoration: BoxDecoration(
                                      borderRadius:
                                          BorderRadius.circular(5 * fem),
                                      border:
                                          Border.all(color: Color(0xffa5c6e4)),
                                    ),
                                    child: TextField(
                                      controller: datetimeinput,
                                      decoration: InputDecoration(
                                        border: InputBorder.none,
                                        hintText: 'Pilih tanggal',
                                        hintStyle:
                                            TextStyle(color: Color(0xffcad5ea)),
                                      ),
                                      style: GoogleFonts.poppins(
                                          fontSize: 10 * ffem,
                                          color: Colors.black),
                                      // textAlign: TextAlign.end,
                                      readOnly: true,
                                      onTap: () async {
                                        DateTime? pickedDatae =
                                            await showDatePicker(
                                                context: context,
                                                initialDate: DateTime.now(),
                                                firstDate: DateTime(2000),
                                                lastDate: DateTime(2100));
                                        if (pickedDatae != null) {
                                          String formatDate =
                                              DateFormat('dd-MM-yyyy')
                                                  .format(pickedDatae);
                                          setState(() {
                                            datetimeinput.text = formatDate;
                                          });
                                        } else {
                                          print("Data tidak dipilih.");
                                          datetimeinput.text = "";
                                        }
                                      },
                                    ),
                                  )
                                ],
                              ),
                            ),
                          ),
                          Positioned(
                            // group186ciV (2:893)
                            left: 58 * fem,
                            top: 390 * fem,
                            child: Container(
                              width: 244 * fem,
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
                                      'Waktu',
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
                                        15 * fem, 0 * fem, 15 * fem, 0 * fem),
                                    width: double.infinity,
                                    height: 40 * fem,
                                    decoration: BoxDecoration(
                                      borderRadius:
                                          BorderRadius.circular(5 * fem),
                                      border:
                                          Border.all(color: Color(0xffa5c6e4)),
                                    ),
                                    child: TextField(
                                      controller: _timeController,
                                      onTap: () {
                                        _selectTime(context);
                                      },
                                      readOnly: true,
                                      decoration: InputDecoration(
                                        hintText: 'Pilih jam',
                                        hintStyle:
                                            TextStyle(color: Color(0xffcad5ea)),
                                        border: InputBorder.none,
                                        contentPadding: EdgeInsets.symmetric(
                                            vertical: 10 * fem),
                                      ),
                                      style: GoogleFonts.poppins(
                                        fontSize: 11 * ffem,
                                        height: 1.5 * ffem / fem,
                                        color: Colors.black,
                                      ),
                                    ),
                                  )
                                ],
                              ),
                            ),
                          ),
                          Positioned(
                            left: 58 * fem,
                            top: 465 * fem,
                            child: Container(
                              width: 244 * fem,
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
                                      'Tempat',
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
                                        15 * fem, 0 * fem, 15 * fem, 0 * fem),
                                    width: double.infinity,
                                    height: 40 * fem,
                                    decoration: BoxDecoration(
                                      borderRadius:
                                          BorderRadius.circular(5 * fem),
                                      border:
                                          Border.all(color: Color(0xffa5c6e4)),
                                    ),
                                    child: TextField(
                                      controller: tempat,
                                      decoration: InputDecoration(
                                        border: InputBorder.none,
                                        focusedBorder: InputBorder.none,
                                        enabledBorder: InputBorder.none,
                                        errorBorder: InputBorder.none,
                                        disabledBorder: InputBorder.none,
                                        hintText: 'Pilih tempat',
                                        hintStyle:
                                            TextStyle(color: Color(0xffcad5ea)),
                                      ),
                                      style: GoogleFonts.poppins(
                                        fontSize: 11 * ffem,
                                        height: 1.5 * ffem / fem,
                                        color: Colors.black,
                                      ),
                                    ),
                                  )
                                ],
                              ),
                            ),
                          ),
                          Positioned(
                            // group190a2M (2:939)
                            left: 58 * fem,
                            top: 548 * fem,
                            child: TextButton(
                              onPressed: () {},
                              style: TextButton.styleFrom(
                                padding: EdgeInsets.zero,
                              ),
                              child: Container(
                                width: 244 * fem,
                                height: 40 * fem,
                                decoration: BoxDecoration(
                                  color: Color(0xff4bbbfa),
                                  borderRadius: BorderRadius.circular(5 * fem),
                                ),
                                child: Center(
                                  child: Text(
                                    'Simpan',
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
                    )
                  ]),
            ),
          )
        ],
      ),
    );
  }
}
