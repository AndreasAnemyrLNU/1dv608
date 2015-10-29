# 1dv608


Programming Project 1dv608

IWish
For a group(families etc) that want's
to switch ONE parcel persons to person.

Requirement spec::

Systems need to follow MVC patter (....D.Toll version)
System has responsive design.
System shows a complete list of members of group.
Systems generates a serialized and crypted file at web,
possible to download but not easy to read for a "regular person"

Security
    For first beta it's not primary.
    But code must be ready to easily validate.

UC1 User
    User enter application and system generates a start page.
    Systen generates a navigation.

UC2 User
    User press the link "BigWishList".
    New page rendered with all memers of a group.

UC3 User
    Pre:
        UC2
            User clicks button "View" for user.
            Persons list of "wishes" is presented.

UC4 User (logged in)
    Pre:
        UC3
            User clicks button
            For everry row page render buttons that
            makes a row editable - also possible to deletete.

UC5 User
    Pre:
        UC4
            User clicks Edit
            State changes to edit mode for a persons "wishlist"

UC6 User
    Pre:
        UC5
            User makes some changes
            The form has rendered button to save changes persistent.
            System displays a succesmessages in top of page.

UC7 User
    Pre:
        UC3
            User press the delete button
            System want's user to confirm.
            System displays a succesmessages in top of page.

Notes:
        Iteration 1: Implemetn UC1 - UC 7


        Future (...thoughts):
        Make more DAL-classes: that create and reads ::
                                                        File(serializes object)
                                                        XML
                                                        JSON

        A class that can genearate the "person to person list".
        A class






















