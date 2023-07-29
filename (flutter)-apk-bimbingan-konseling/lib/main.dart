import 'package:flutter/material.dart';
import 'package:flutter/gestures.dart';
import 'dart:ui';
import 'package:google_fonts/google_fonts.dart';
import 'package:myapp/pages/detai-pertemuan.dart';
import 'package:myapp/pages/jadwal-pertemuan.dart';
import 'package:myapp/pages/list-view-pertemuan.dart';
import 'package:myapp/pages/login.dart';
import 'package:myapp/pages/splash-screen.dart';
import 'package:myapp/pages/splash-screen2.dart';
import 'package:myapp/pages/detai-pertemuan.dart';
import 'package:shared_preferences/shared_preferences.dart';


void main() => runApp(MyApp());

class MyApp extends StatelessWidget {
	@override
	Widget build(BuildContext context) {
	return MaterialApp(
		title: 'Flutter',
		debugShowCheckedModeBanner: false,
		theme: ThemeData(
		primarySwatch: Colors.blue,
		),
		home: FutureBuilder(
      future: SharedPreferences.getInstance(),
      builder: (context, snapshot) {
        if (snapshot.connectionState == ConnectionState.waiting) {
          return Center(
            child: CircularProgressIndicator(),
          );
        } else if (snapshot.hasError) {
          return Text('Some error has Occurred');
        } else if (snapshot.hasData) {
          final token = snapshot.data!.getString('token');
          if (token != null){}
          return  SplashScreen1();
        } else {
          return LoginPage();
        }
      },
    ),
	);
	}
}
