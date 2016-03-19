//////////////////////////////////////////////////////////////////////////////
//  CIS554#Object-Oriented Programming in C++
//  HW_9
//  implementation of class MyRect
//  not be changed
//  MyRect.cpp
//////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
// Joe Waclawski
// CIS 554
// MyRect
//
// Description: Implementation of class MyRect. See MyRect.h for details
//
///////////////////////////////////////////////////////////////////////////////
#include "MyRect.h"

using std::cout;
using std::cin;
using std::endl;



///////////////////////////////////////////////////////////////////////////////
// MyRect default constructor
///////////////////////////////////////////////////////////////////////////////
MyRect::MyRect()
// initialize default rectangle attributes
: rectLength(WINDOW_MAXY/4),
  rectWidth(WINDOW_MAXX/4)
{}

///////////////////////////////////////////////////////////////////////////////
// MyRect::Draw()
///////////////////////////////////////////////////////////////////////////////
bool MyRect::Draw()
{
	// set up attributes of rectangle using FilledShapes
	fs.SetPenColor(borderColor);
	fs.SetBrushColor(fillColor);

	// draw rectangle with set attributes
	// when drawing, take into account the border width by subtracting the border
	// width appropriately from the length and width. that way, the given length
	// and width include the width of the border
	fs.FilledRectangle(position,rectLength-2*borderWidth,rectWidth-2*borderWidth);

	return true;
}

///////////////////////////////////////////////////////////////////////////////
// MyRect::SetLength()
///////////////////////////////////////////////////////////////////////////////
bool MyRect::SetLength(unsigned int length)
{
	// need to account for a min length and width based
	// upon the border width
	if ( length <= 2*borderWidth ) return false;

	// check to make sure the new length is valid based on current position
	// and window height
	if ( length < (GetWindowHeight()-position.y) )
	{
		rectLength = length;
		return true;
	}
	else
	{
		return false;
	}
}

///////////////////////////////////////////////////////////////////////////////
// MyRect::SetWidth()
///////////////////////////////////////////////////////////////////////////////
bool MyRect::SetWidth(unsigned int width)
{

	// need to account for a min length and width based
	// upon the border width
	if ( width <= 2*borderWidth ) return false;

	// check to make sure new width is valid based on current position
	// and window width
	if ( width < (GetWindowWidth()-position.x) )
	{
		rectWidth = width;
		return true;
	}
	else
	{
		return false;
	}
}

///////////////////////////////////////////////////////////////////////////////
// MyRect::SetPosition()
///////////////////////////////////////////////////////////////////////////////
bool MyRect::SetPosition(POINT & p)
{
	// make sure new position is valid based on current length, width,
	// and window size
	if ( 
		(rectWidth + borderWidth < (GetWindowWidth()-p.x)) &&
		(rectLength + borderWidth < (GetWindowHeight()-p.y)) 
		)
	{
		position.x = p.x;
		position.y = p.y;
		return true;
	}
	else
	{
		return false;
	}
}


///////////////////////////////////////////////////////////////////////////////
// MyRect::GetWidth()
///////////////////////////////////////////////////////////////////////////////
unsigned int MyRect::GetWidth()
{
	return rectWidth;
}

///////////////////////////////////////////////////////////////////////////////
// MyRect::GetLength()
///////////////////////////////////////////////////////////////////////////////
unsigned int MyRect::GetLength()
{
	return rectLength;
}
